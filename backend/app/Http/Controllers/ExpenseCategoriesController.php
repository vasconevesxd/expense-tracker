<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoriesController extends Controller
{
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();
        return response()->json($expenseCategories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $expenseCategory = ExpenseCategory::create($validated);
        return response()->json($expenseCategory, 201);
    }

    public function show($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        return response()->json($expenseCategory);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->update($validated);
        return response()->json($expenseCategory);
    }

    public function destroy($id)
    {
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expenseCategory->delete();
        return response()->json(null, 204);
    }
}
