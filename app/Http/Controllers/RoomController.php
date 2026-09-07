<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('name')->get();

        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name',
            'department' => 'required|in:RECEPTION,SCREENING,CONSULTATION,MATERNITY,CHRONIC,ADMINISTRATION',
            'room_type' => 'nullable|string|max:255',
        ]);

        Room::create([
            'name' => $validated['name'],
            'department' => $validated['department'],
            'room_type' => $validated['room_type'] ?? null,
            'is_active' => true,
        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name,' . $room->id,
            'department' => 'required|in:RECEPTION,SCREENING,CONSULTATION,MATERNITY,CHRONIC,ADMINISTRATION',
            'room_type' => 'nullable|string|max:255',
        ]);

        $room->update([
            'name' => $validated['name'],
            'department' => $validated['department'],
            'room_type' => $validated['room_type'] ?? null,
        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    public function toggleStatus(Room $room)
    {
        $room->update([
            'is_active' => !$room->is_active,
        ]);

        return back()->with('success', 'Room status updated successfully.');
    }
}