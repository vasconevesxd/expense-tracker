<?php

namespace App\Http\Controllers;

use App\Models\IncomeType;
use Illuminate\Http\Request;

class IncomeTypesController extends Controller
{
    public function index()
    {
        $incomeTypes = IncomeType::all();
        return response()->json($incomeTypes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|in:Salary,Extra']);
        $incomeType = IncomeType::create($validated);
        return response()->json($incomeType, 201);
    }

    public function show($id)
    {
        $incomeType = IncomeType::findOrFail($id);
        return response()->json($incomeType);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|in:Salary,Extra']);
        $incomeType = IncomeType::findOrFail($id);
        $incomeType->update($validated);
        return response()->json($incomeType);
    }

    public function destroy($id)
    {
        $incomeType = IncomeType::findOrFail($id);
        $incomeType->delete();
        return response()->json(null, 204);
    }
}
