<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('tiket')->orderBy('tanggal')->get();

        return view('admin.event.interface', compact('events'));
    }

    public function create()
{
    $kategori = \App\Models\Kategori::orderBy('nama')->get();
    return view('admin.event.create_event', compact('kategori'));
}
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('nama', 'tanggal', 'lokasi', 'deskripsi');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('events', 'public');
        }

        Event::create($data);

        return redirect()->route('admin.event.index')->with('success', 'Event successfully added.');
    }

    public function edit(Event $event)
{
    $kategori = Kategori::orderBy('nama')->get();
    return view('admin.event.edit_event', compact('event', 'kategori'));
}

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('nama', 'kategori_id', 'tanggal', 'lokasi', 'deskripsi');

        if ($request->hasFile('foto')) {
            if ($event->foto) {
                Storage::disk('public')->delete($event->foto);
            }
            $data['foto'] = $request->file('foto')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.event.index')->with('success', 'Event successfully updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus.');
    }
}
