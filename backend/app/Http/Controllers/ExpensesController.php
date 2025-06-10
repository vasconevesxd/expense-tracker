<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expense::with(['category', 'expenseType'])->get();
        return response()->json($expenses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'type_id' => 'required|exists:expense_types,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        $expense = Expense::create($validated);
        return response()->json($expense, 201);
    }

    public function show($id)
    {
        $expense = Expense::with(['category', 'expenseType'])->findOrFail($id);
        return response()->json($expense);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'type_id' => 'required|exists:expense_types,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);
        $expense = Expense::findOrFail($id);
        $expense->update($validated);
        return response()->json($expense);
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        return response()->json(null, 204);
    }
}
