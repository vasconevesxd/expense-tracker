<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::with(['person', 'incomeType'])->get();
        return response()->json($incomes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'type_id' => 'required|exists:income_types,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);
        $income = Income::create($validated);
        return response()->json($income, 201);
    }

    public function show($id)
    {
        $income = Income::with(['person', 'incomeType'])->findOrFail($id);
        return response()->json($income);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'person_id' => 'required|exists:people,id',
            'type_id' => 'required|exists:income_types,id',
            'amount' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);
        $income = Income::findOrFail($id);
        $income->update($validated);
        return response()->json($income);
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return response()->json(null, 204);
    }
}
