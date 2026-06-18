<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\TiketMail;
use Illuminate\Support\Facades\Mail;

class PembayaranController extends Controller
{
  public function index(Request $request) // Fungsi untuk menampilkan data pembayaran.
    {
        // WAJIB menggunakan with(['tiket.event']) agar relasi berantai dimuat
        $query = Pembayaran::with(['tiket.event']);

        // Mencari nama peserta yang mengandung kata tertentu atau email
        if ($request->has('search')) {
            $query->where('nama_peserta', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $pembayaran = $query->latest()->get(); //Mengambil seluruh data, urut dari yg terakhir atau terbaru

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
        // 1. Menjalankan validasi sebelum data disimpan.
        $request->validate([
            'nama_peserta' => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'ticket_type'  => 'required|string',
            'price'        => 'required|numeric',
            'proof'        => 'required|image|mimes:jpeg,png,jpg|max:2048', // Batasi gambar maks 2MB
        ]);

        // 2. Kelola penyimpanan file bukti transfer
        $fileName = null; // Membuat variabel untuk menyimpan nama file.
        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            // Menamai file agar unik: contoh 'bukti_1654300000.png'
            $fileName = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
            // Dipindahkan ke direktori local: public/uploads/proofs/
            $file->move(public_path('uploads/proofs'), $fileName);
        }

        // 3. Insert data ke database 
        // Menambahkan data baru ke tabel pembayaran.
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
    
        // Load relasi tiket & event sebelum dikirim ke email
        $pembayaran->load('tiket.event');
    
        // Kirim e-ticket ke email peserta
        try {
            Mail::to($pembayaran->email)->send(new TiketMail($pembayaran));
            $message = 'Payment successfully approved and e-ticket sent to ' . $pembayaran->email;
        } catch (\Exception $e) {
            \Log::error('Gagal kirim email tiket: ' . $e->getMessage());
            $message = 'Payment approved, but failed to send e-ticket email.';
        }
    
        return redirect()->route('admin.pembayaran.index')
            ->with('success', $message);
    }

    public function reject(Request $request, Pembayaran $pembayaran)
    {
        $request->validate(['catatan' => 'nullable|string|max:500']);
        $pembayaran->update([
            'status'  => 'Rejected',
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Payment rejected.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        if ($pembayaran->bukti_transfer) {
            $filePath = public_path('uploads/proofs/' . $pembayaran->bukti_transfer);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $pembayaran->delete();
        return redirect()->route('admin.pembayaran.index')
            ->with('success', 'Payment record deleted.');
    }
    public function searchByEmail(Request $request)
    {
        $email = $request->query('email');
    
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['error' => 'Email tidak valid'], 422);
        }
    
        $pembayarans = Pembayaran::with('tiket.event')
            ->where('email', $email)
            ->latest()
            ->get();
    
        $data = $pembayarans->map(function ($p) {
            $tiket = $p->tiket;
            $event = $tiket?->event;
    
            return [
                'id'            => 'TXN-' . str_pad($p->id, 5, '0', STR_PAD_LEFT),
                'event'         => $event?->nama ?? '-',
                'ticket'        => $tiket?->nama_tiket ?? '-',
                'date'          => $p->created_at->format('d M Y'),
                'eventDatetime' => $event
                                    ? \Carbon\Carbon::parse($event->tanggal)->format('d M Y') .
                                      ($event->jam_mulai ? ', ' . \Carbon\Carbon::parse($event->jam_mulai)->format('H:i') : '')
                                    : '-',
                'amount'        => 'Rp ' . number_format($p->total_bayar, 0, ',', '.'),
                'status'        => match($p->status) {
                    'Approved' => 'success',
                    'Pending'  => 'pending',
                    'Rejected' => 'failed',
                    default    => 'pending',
                },
            ];
        });
    
        return response()->json($data);
    }
}
