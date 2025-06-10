<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\IncomeTypesController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseCategoriesController;
use App\Http\Controllers\ExpenseTypesController;
use App\Http\Controllers\ExpensesController;

Route::apiResource('people', PeopleController::class);
Route::apiResource('income-types', IncomeTypesController::class);
Route::apiResource('income', IncomeController::class);
Route::apiResource('expense-categories', ExpenseCategoriesController::class);
Route::apiResource('expense-types', ExpenseTypesController::class);
Route::apiResource('expenses', ExpensesController::class);