<?php

namespace App\Http\Controllers;

use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypesController extends Controller
{
    public function index()
    {
        $expenseTypes = ExpenseType::all();
        return response()->json($expenseTypes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|in:Essential,Well-being,Luxury']);
        $expenseType = ExpenseType::create($validated);
        return response()->json($expenseType, 201);
    }

    public function show($id)
    {
        $expenseType = ExpenseType::findOrFail($id);
        return response()->json($expenseType);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|in:Essential,Well-being,Luxury']);
        $expenseType = ExpenseType::findOrFail($id);
        $expenseType->update($validated);
        return response()->json($expenseType);
    }

    public function destroy($id)
    {
        $expenseType = ExpenseType::findOrFail($id);
        $expenseType->delete();
        return response()->json(null, 204);
    }
}
