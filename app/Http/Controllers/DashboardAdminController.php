<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class DashboardAdminController extends Controller
{
    // tampil dashboard
    public function index()
    {
        $events = Event::all();

        $eventActive = Event::count();
        $orders = 3;

        return view('admindashboard', compact(
            'events',
            'eventActive',
            'orders'
        ));
    }

    // CREATE EVENT
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'category' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png,jpg'
        ]);

        // upload foto
        $photoName = time() . '.' . $request->photo->extension();

        $request->photo->move(public_path('uploads'), $photoName);

        // simpan database
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'category' => $request->category,
            'photo' => $photoName
        ]);

        return redirect()->back()
            ->with('success', 'Event berhasil ditambahkan');
    }

    // UPDATE EVENT
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'category' => 'required'
        ]);

        // kalau upload foto baru
        if ($request->hasFile('photo')) {

            $photoName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('uploads'), $photoName);

            $event->photo = $photoName;
        }

        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->location = $request->location;
        $event->category = $request->category;

        $event->save();

        return redirect()->back()
            ->with('success', 'Event berhasil diupdate');
    }

    // DELETE EVENT
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return redirect()->back()
            ->with('success', 'Event berhasil dihapus');
    }
}
