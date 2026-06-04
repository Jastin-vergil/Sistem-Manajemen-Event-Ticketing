<?php

namespace App\Http\Controllers;

// WAJIB: Import model Pembayaran dan Event di sini agar tidak 'not found'
use App\Models\Pembayaran;
use App\Models\Event; 
use Illuminate\Http\Request;

class AdminParticipantController extends Controller
{
    public function index()
    {
        // Gunakan eager loading 'with' agar relasi tiket dan event terbaca sekaligus
        $participants = Pembayaran::with(['tiket.event'])
            ->latest()
            ->get();

        // Ambil data statistics untuk mencegah error Undefined variable $stats
        $stats = [
            'total'    => Pembayaran::count(),
            'pending'  => Pembayaran::where('status', 'Pending')->count(),
            'approved' => Pembayaran::whereIn('status', ['Approved', 'Verified'])->count(),
            'rejected' => Pembayaran::where('status', 'Rejected')->count(),
        ];

        return view('admin.pembayaran.interface', compact('participants', 'stats'));
    }
}