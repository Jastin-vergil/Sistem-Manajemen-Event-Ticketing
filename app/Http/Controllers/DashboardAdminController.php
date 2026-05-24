<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('admin.admin_dashboard', compact('events'));
    }

    public function store(Request $request)
    {
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('events', 'public');
        }

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'category' => $request->category,
            'photo' => $photoPath,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $photoPath = $event->photo;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('events', 'public');
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'location' => $request->location,
            'category' => $request->category,
            'photo' => $photoPath,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();

        return redirect()->back();
    }
}
