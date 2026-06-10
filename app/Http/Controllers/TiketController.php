<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        $tiket  = Tiket::with('event')->latest()->get();
        $events = Event::orderBy('tanggal')->get();

        $stats = [
            'total'      => $tiket->count(),
            'terjual'    => $tiket->sum('terjual'),
            'tersisa'    => $tiket->sum(fn($t) => $t->kuota - $t->terjual),
            'pendapatan' => $tiket->sum(fn($t) => $t->harga * $t->terjual),
        ];

        return view('admin.ticket.interface', compact('tiket', 'events', 'stats'));
    }

    public function create()
    {
        $events = Event::orderBy('tanggal')->get();
        return view('admin.ticket.create_ticket', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id'      => 'required|exists:events,id',
            'nama_tiket'    => 'required|string|max:100',
            'harga'         => 'required|integer|min:0',
            'kuota'         => 'required|integer|min:1',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'        => 'required|in:Aktif,Draft,Habis,Hampir Habis',
            'keterangan'    => 'nullable|string',
        ]);

        Tiket::create($request->all());

        return redirect()->route('admin.ticket.interface')->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function edit(Tiket $tiket)
    {
        $events = Event::orderBy('tanggal')->get();
        return view('admin.ticket.edit_ticket', compact('tiket', 'events'));
    }

    public function update(Request $request, Tiket $tiket)
    {
        $request->validate([
            'event_id'      => 'required|exists:events,id',
            'nama_tiket'    => 'required|string|max:100',
            'harga'         => 'required|integer|min:0',
            'kuota'         => 'required|integer|min:1',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'        => 'required|in:Aktif,Draft,Habis,Hampir Habis',
            'keterangan'    => 'nullable|string',
        ]);

        $tiket->update($request->all());

        return redirect()->route('admin.ticket.interface')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Tiket $tiket)
    {
        $tiket->delete();
        return redirect()->route('admin.ticket.interface')->with('success', 'Tiket berhasil dihapus.');
    }

    // Tambahkan function baru ini
    public function ticketForm(Request $request)
    {
        $eventId = $request->query('event');

        $tickets = Tiket::where('status', 'Aktif')
                        ->where('event_id', $eventId) // ← apakah baris ini sudah ada?
                        ->get();

        return view('Pages.ticket', compact('tickets'));
    }
}
