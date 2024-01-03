<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;


class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Meeting::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            
        ]);

        $meeting = Meeting::create($validatedData);
        return response()->json($meeting, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $meeting = Meeting::find($id);
        return $meeting ? response()->json($meeting) : response()->json(['error' => 'Meeting not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            // Tambahkan validasi lain sesuai kolom di tabel meetings
        ]);

        $meeting = Meeting::find($id);

        if ($meeting) {
            $meeting->update($validatedData);
            return response()->json($meeting);
        }

        return response()->json(['error' => 'Meeting not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $meeting = Meeting::find($id);

        if ($meeting) {
            $meeting->delete();
            return response()->json(['message' => 'Meeting deleted successfully']);
        }

        return response()->json(['error' => 'Meeting not found'], 404);
    }
}

