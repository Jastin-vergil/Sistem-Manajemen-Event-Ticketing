<?php

namespace App\Http\Controllers;

// WAJIB: Import model Pembayaran dan Event di sini agar tidak 'not found'
use App\Models\Pembayaran;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminParticipantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Gunakan eager loading 'with' agar relasi tiket dan event terbaca sekaligus
        $participants = Pembayaran::with(['tiket.event'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_pembeli', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Ambil data statistics untuk mencegah error Undefined variable $stats
        // Tidak ikut terfilter search, tetap hitung dari total keseluruhan
        $stats = [
            'total'    => Pembayaran::count(),
            'pending'  => Pembayaran::where('status', 'Pending')->count(),
            'approved' => Pembayaran::whereIn('status', ['Approved', 'Verified'])->count(),
            'rejected' => Pembayaran::where('status', 'Rejected')->count(),
        ];

        return view('admin.pembayaran.interface', compact('participants', 'stats'));
    }
}
