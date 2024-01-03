<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Creator;


class CreatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Creator::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'profile_photo' => 'nullable|image', 
        'username' => 'required|max:255',
        'is_verified' => 'nullable|boolean'
    ]);

    if ($request->hasFile('profile_photo')) {
        $filename = time() . '.' . $request->profile_photo->getClientOriginalExtension();
        $request->profile_photo->move(public_path('images'), $filename);
        $validatedData['profile_photo'] = '/images/' . $filename;
    }

    $creator = Creator::create($validatedData);
    return response()->json($creator, 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $creator = Creator::find($id);
        return $creator ? response()->json($creator) : response()->json(['error' => 'Creator not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'profile_photo' => 'nullable|image', 
            'username' => 'required|max:255',
            'is_verified' => 'nullable|boolean'
        ]);

        $creator = Creator::find($id);

        if ($creator) {
            $creator->update($validatedData);
            return response()->json($creator);
        }

        return response()->json(['error' => 'Creator not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $creator = Creator::find($id);

        if ($creator) {
            $creator->delete();
            return response()->json(['message' => 'Creator deleted successfully']);
        }

        return response()->json(['error' => 'Creator not found'], 404);
    }
}
