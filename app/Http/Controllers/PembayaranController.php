<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
  public function index(Request $request)
{
    // WAJIB menggunakan with(['tiket.event']) agar relasi berantai dimuat
    $query = Pembayaran::with(['tiket.event']);

    if ($request->has('search')) {
        $query->where('nama_peserta', 'like', '%' . $request->search . '%')
              ->orWhere('email', 'like', '%' . $request->search . '%');
    }

    $pembayaran = $query->latest()->get();

    // Pastikan $stats juga dikirim agar tidak memicu error undefined variable kembali
    $stats = [
        'total'    => Pembayaran::count(),
        'pending'  => Pembayaran::where('status', 'Pending')->count(),
        'approved' => Pembayaran::where('status', 'Approved')->orWhere('status', 'Verified')->count(),
        'rejected' => Pembayaran::where('status', 'Rejected')->orWhere('status', 'Declined')->count(),
    ];

    return view('admin.pembayaran.interface', compact('pembayaran', 'stats'));
}


    public function store(Request $request)
    {
        // 1. Validasi request dari form
        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'ticket_type'  => 'required|string',
            'price'        => 'required|numeric',
            'proof'        => 'required|image|mimes:jpeg,png,jpg|max:2048', // Batasi gambar maks 2MB
        ]);

        // 2. Kelola penyimpanan file bukti transfer
        $fileName = null;
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            // Menamai file agar unik: contoh 'bukti_1654300000.png'
            $fileName = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
            // Dipindahkan ke direktori local: public/uploads/proofs/
            $file->move(public_path('uploads/proofs'), $fileName);
        }

        // 3. Insert data ke database melalui Eloquent ORM
        Pembayaran::create([
            'tiket_id'      => $request->ticket_type,
            'nama_peserta'  => $request->nama_peserta,
            'email'         => $request->email,
            'total_bayar'   => $request->price,
            'bukti_transfer'=> $fileName,
            'status'        => 'Pending',
        ]);

        // 4. Redirect kembali dengan flash message sukses
        return redirect()->back()->with('success', 'Payment proof submitted successfully! Please wait for admin confirmation.');
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('tiket.event');
        return view('admin.pembayaran.show_form', compact('pembayaran'));
    }

    public function approve(Pembayaran $pembayaran)
{
    $pembayaran->update(['status' => 'Approved']);

    $tiket = Tiket::where('id', $pembayaran->tiket_id)->first();
    
    if ($tiket) {
        $tiket->increment('terjual', 1);
    }

    return redirect()->route('admin.pembayaran.index')
        ->with('success', 'Payment successfully approved.');
}

    public function reject(Request $request, Pembayaran $pembayaran)
    {
        $request->validate(['catatan' => 'nullable|string|max:500']);
        $pembayaran->update([
            'status'  => 'Rejected',
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('admin.pembayaran.index')->with('success', 'Payment rejected.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        if ($pembayaran->bukti_transfer) {
            Storage::disk('public')->delete($pembayaran->bukti_transfer);
        }
        $pembayaran->delete();
        return redirect()->route('admin.pembayaran.index')->with('success', 'Payment record deleted.');
    }
}
