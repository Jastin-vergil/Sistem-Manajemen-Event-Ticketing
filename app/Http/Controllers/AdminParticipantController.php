<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;

class AdminParticipantController extends Controller
{
    public function index()
    {
        // mengganti Payment menjadi Pembayaran, dan gunakan eager loading 'with' agar relasi tiket/event terbaca
        $participants = Pembayaran::with(['tiket.event'])
            ->where('status', 'approved')
            ->latest()
            ->get();

        // memastikan view mengarah ke index blade miliki peserta
        return view('admin.participants.index', compact('participants'));
    }
}