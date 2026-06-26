<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class landing_page extends Controller

{
    public function index()
    {
        $events = Event::select('id', 'name', 'foto', 'slug')
        ->whereNotNull('foto')
        ->latest()
        ->take(4)
        ->get();

        return view('landing', compact('events')); // sesuaikan nama view-nya
    }
}

