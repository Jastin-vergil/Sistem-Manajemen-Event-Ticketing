<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Event;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
			'lokasi' => 'required|string|max:255',
			'deskripsi' => 'nullable|string',
			'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
			'jam_mulai'   => 'required|string',
            'jam_selesai' => 'required|string',
		]
        , [
            'nama.required'    => 'The event name field is required.',
            'lokasi.required'  => 'The event location field is required.',
            'tanggal.required' => 'The event date field is required.',
            'jam_mulai.required' => 'The event start time field is required.',
            'jam_selesai.required' => 'The event end time field is required.',
            'foto.required' => 'The event image field is required.',
            'foto.image' => 'The uploaded file must be an image.',
            'foto.mimes' => 'The uploaded image must be in jpg, jpeg, png, or webp format.',
            'foto.max' => 'The uploaded image must not exceed 2MB in size.',
        ]);

		$data = $request->only('nama', 'kategori_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi');

		if ($request->hasFile('foto')) {
			$data['foto'] = $request->file('foto')->store('events', 'public');
		}

		Event::create(array_merge($data, [
            'admin_id' => Auth::id(),
        ]));

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
			'lokasi' => 'required|string|max:255',
			'deskripsi' => 'nullable|string',
			'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
           'jam_mulai'   => 'required|string',
            'jam_selesai' => 'required|string'],
        [
            'nama.required'    => 'The event name field is required.',
            'lokasi.required'  => 'The event location field is required.',
            'tanggal.required' => 'The event date field is required.',
            'jam_mulai.required' => 'The event start time field is required.',
            'jam_selesai.required' => 'The event end time field is required.',
            'foto.required' => 'The event image field is required.',
            'foto.image' => 'The uploaded file must be an image.',
            'foto.mimes' => 'The uploaded image must be in jpg, jpeg, png, or webp format.',
            'foto.max' => 'The uploaded image must not exceed 2MB in size.',
        ]);
		$data = $request->only('nama', 'kategori_id', 'tanggal', 'jam_mulai', 'jam_selesai', 'lokasi', 'deskripsi');
		if ($request->hasFile('foto')) {
			if ($event->foto) {
				Storage::disk('public')->delete($event->foto);
			}
			$data['foto'] = $request->file('foto')->store('events', 'public');
		}

		Event::create(array_merge($request->all(), [
            'admin_id' => Auth::id(),
        ]));

		return redirect()->route('admin.event.index')->with('success', 'Event successfully updated.');
	}

	public function destroy(Event $event)
	{
		$event->delete();

		return redirect()->route('admin.event.index')->with('success', 'Event succesfully deleted.');
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
