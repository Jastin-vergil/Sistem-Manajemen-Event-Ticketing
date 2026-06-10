<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Event;
use App\Models\Pembayaran;
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
			'jam_mulai'   => 'nullable|string',
            'jam_selesai' => 'nullable|string',
		]);

		$data = $request->only('nama', 'kategori_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi');

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
           'jam_mulai'   => 'nullable|string',
            'jam_selesai' => 'nullable|string',
		]);

		$data = $request->only('nama', 'kategori_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi');
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

	/**
	 * Menampilkan halaman khusus berisi tabel peserta dari event tertentu
	 */
	public function showParticipants(Event $event)
	{
	    $participants = Pembayaran::whereHas('tiket', function($q) use ($event) {
	            $q->where('event_id', $event->id);
	        })
	        ->where('status', 'Approved')
	        ->with('tiket')
	        ->latest()
	        ->get();
	
	    return response()->json([
	        'event' => $event->nama,
	        'participants' => $participants->map(fn($p) => [
	            'nama'        => $p->nama_peserta,
	            'email'       => $p->email,
	            'tiket'       => $p->tiket->nama_tiket ?? '-',
	            'total_bayar' => 'Rp ' . number_format($p->total_bayar, 0, ',', '.'),
	            'status'      => $p->status,
	        ])
	    ]);
	}
}
