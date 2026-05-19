<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Cinema;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of rooms.
     */
    public function index(Request $request)
    {
        $query = Room::with('cinema');

        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $rooms = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('admin.rooms.index', compact('rooms', 'search'));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        $cinemas = Cinema::all();
        return view('admin.rooms.create', compact('cinemas'));
    }

    /**
     * Store a newly created room.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cinema_id'   => 'required|exists:cinemas,id',
            'name'        => 'required|string|max:255',
            'room_type'   => 'required|string|max:50',
            'total_seats' => 'required|integer|min:0',
            'status'      => 'required|in:active,inactive',
        ]);

        Room::create($validated);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room created successfully.');
    }

    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        $room->load('cinema', 'seats');
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit(Room $room)
    {
        $cinemas = Cinema::all();
        return view('admin.rooms.edit', compact('room', 'cinemas'));
    }

    /**
     * Update the specified room.
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'cinema_id'   => 'required|exists:cinemas,id',
            'name'        => 'required|string|max:255',
            'room_type'   => 'required|string|max:50',
            'total_seats' => 'required|integer|min:0',
            'status'      => 'required|in:active,inactive',
        ]);

        $room->update($validated);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified room.
     */
    public function destroy(Room $room)
    {
        // delete seats belonging to this room
        $room->seats()->delete();

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}


