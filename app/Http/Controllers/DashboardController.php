<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::with('kategori')->get();
        $kategori = Kategori::all();

        return view('Pages.landing_page', compact('events', 'kategori'));
    }
}