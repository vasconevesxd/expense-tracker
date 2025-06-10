<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $people = People::all();
        return response()->json($people);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $people = People::create($validated);
        return response()->json($people, 201);
    }

    public function show($id)
    {
        $people = People::findOrFail($id);
        return response()->json($people);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $people = People::findOrFail($id);
        $people->update($validated);
        return response()->json($people);
    }

    public function destroy($id)
    {
        $people = People::findOrFail($id);
        $people->delete();
        return response()->json(null, 204);
    }
}
