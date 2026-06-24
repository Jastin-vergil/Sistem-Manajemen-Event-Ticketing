<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        $tiket = Tiket::with('event')->latest()->get();
        $events = Event::orderBy('tanggal')->get();

        $stats = [
            'total' => $tiket->count(),
            'terjual' => $tiket->sum('terjual'),
            'tersisa' => $tiket->sum(fn ($t) => $t->kuota - $t->terjual),
            'pendapatan' => $tiket->sum(fn ($t) => $t->harga * $t->terjual),
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
            'event_id' => 'required|exists:events,id',
            'nama_tiket' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Aktif,Draft,Habis,Hampir Habis',
            'keterangan' => 'nullable|string',
        ], [
            'event_id.required' => 'Event is required.',
            'event_id.exists' => 'Selected event does not exist.',
            'nama_tiket.required' => 'Ticket name is required.',
            'harga.required' => 'Price is required.',
            'harga.integer' => 'Price must be a whole number.',
            'harga.min' => 'Price cannot be negative.',
            'kuota.required' => 'Quota is required.',
            'kuota.integer' => 'Quota must be a whole number.',
            'kuota.min' => 'Quota must be at least 1.',
            'tanggal_akhir.after_or_equal' => 'End date must be after or equal to start date.',
            'status.required' => 'Status is required.',
        ]);

        Tiket::create($request->all());

        return redirect()->route('admin.ticket.interface')->with('success', 'Ticket Has Been Added.');
    }

    public function edit(Tiket $tiket)
    {
        $events = Event::orderBy('tanggal')->get();

        return view('admin.ticket.edit_ticket', compact('tiket', 'events'));
    }

    public function update(Request $request, Tiket $tiket)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'nama_tiket' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Aktif,Draft,Habis,Hampir Habis',
            'keterangan' => 'nullable|string',
        ], [
            'event_id.required' => 'Event is required.',
            'event_id.exists' => 'Selected event does not exist.',
            'nama_tiket.required' => 'Ticket name is required.',
            'harga.required' => 'Price is required.',
            'harga.integer' => 'Price must be a whole number.',
            'harga.min' => 'Price cannot be negative.',
            'kuota.required' => 'Quota is required.',
            'kuota.integer' => 'Quota must be a whole number.',
            'kuota.min' => 'Quota must be at least 1.',
            'tanggal_akhir.after_or_equal' => 'End date must be after or equal to start date.',
            'status.required' => 'Status is required.',
        ]);

        $tiket->update($request->all());
        $tiket->refresh();
        $tiket->updateStatus();

        return redirect()->route('admin.ticket.interface')->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Tiket $tiket)
    {
        $tiket->delete();

        return redirect()->route('admin.ticket.interface')->with('success', 'Tiket Has Been Deleted.');
    }

    public function ticketForm(Request $request)
    {
        $eventId = $request->query('event');

        $tickets = Tiket::where('status', 'Aktif')
            ->where('event_id', $eventId)
            ->where('kuota', '>', 0) // hanya tiket yang punya kuota
            ->whereColumn('terjual', '<', 'kuota') // masih ada sisa
            ->get();

        if ($tickets->isEmpty()) {
            return redirect()->back()->with('error', 'Sorry, The Ticket Is No Longer Available.');
        }

        return view('Pages.ticket', compact('tickets'));
    }
}
