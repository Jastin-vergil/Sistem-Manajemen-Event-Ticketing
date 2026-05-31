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
        $query = Pembayaran::with('tiket.event')->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_peserta', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $pembayaran = $query->get();

        $stats = [
            'total'    => Pembayaran::count(),
            'pending'  => Pembayaran::where('status', 'Pending')->count(),
            'approved' => Pembayaran::where('status', 'Approved')->count(),
            'rejected' => Pembayaran::where('status', 'Rejected')->count(),
        ];

        return view('admin.pembayaran.index', compact('pembayaran', 'stats'));
    }

    public function show(Pembayaran $pembayaran)
    {
        $pembayaran->load('tiket.event');
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function approve(Pembayaran $pembayaran)
    {
        $pembayaran->update(['status' => 'Approved']);
        $pembayaran->tiket->increment('terjual', 1);
        return redirect()->route('admin.pembayaran.index')->with('success', 'Payment successfully approved.');
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
