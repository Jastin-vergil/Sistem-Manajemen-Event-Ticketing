<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->get();
        $eventActive = Event::count();
        $orders = 0;

        return view('admin.admin_dashboard', compact('events', 'eventActive', 'orders'));
    }

    // MEMPROSES SAVE EVENT & DIRECT KE FORM TIKET
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'required|date',
            'time'        => 'required',
            'location'    => 'required|string',
            'category'    => 'required|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $input['photo'] = $imageName;
        }

        // 1. Simpan event dan masukkan ke variabel $event
        $event = Event::create($input);

        // 2. Alihkan langsung ke halaman form tiket membawa ID event yang baru dibuat
        return redirect()->route('admin.tickets.create', ['event_id' => $event->id]);
    }

    // MENAMPILKAN HALAMAN FORM TIKET BARU
    public function createTicket(Request $request)
    {
        // Ambil data event berdasarkan ID yang dikirim lewat URL
        $event = Event::findOrFail($request->event_id);

        return view('admin.create_ticket', compact('event'));
    }

    // MEMPROSES PENYIMPANAN DATA TIKET
    public function storeTicket(Request $request)
    {
        $request->validate([
            'event_id'   => 'required|exists:events,id',
            'ticket_name'=> 'required|string|max:255',
            'price'      => 'required|numeric',
            'stock'      => 'required|integer',
        ]);

        // SINI: Proses simpan ke tabel tiketmu (misal Model Ticket)
        // \App\Models\Ticket::create($request->all());

        // Jika sudah selesai isi tiket, baru balikkan ke dashboard utama
        return redirect()->route('admin.dashboard')->with('success', 'Event dan Tiket berhasil dibuat!');
    }
}
