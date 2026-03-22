<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of expenses.
     */
    public function index()
    {
        $expenses = Expense::orderBy('expense_date', 'desc')
                          ->orderBy('id', 'desc')
                          ->paginate(15);
        
        // Calculate summaries
        $totalExpenses = Expense::sum('amount');
        $todayExpenses = Expense::whereDate('expense_date', today())->sum('amount');
        $monthExpenses = Expense::whereMonth('expense_date', now()->month)
                                ->whereYear('expense_date', now()->year)
                                ->sum('amount');
        
        return view('expenses.index', compact('expenses', 'totalExpenses', 'todayExpenses', 'monthExpenses'));
    }
    
    /**
     * Show the form for creating a new expense.
     */
    public function create()
    {
        return view('expenses.create');
    }
    
    /**
     * Store a newly created expense in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'description' => 'nullable|string|max:1000',
        ]);
        
        Expense::create($validated);
        
        return redirect()->route('expenses.index')
                         ->with('success', 'تم إضافة المصروف بنجاح');
    }
    
    /**
     * Display the specified expense.
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.show', compact('expense'));
    }
    
    /**
     * Show the form for editing the specified expense.
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expenses.edit', compact('expense'));
    }
    
    /**
     * Update the specified expense in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'expense_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'description' => 'nullable|string|max:1000',
        ]);
        
        $expense = Expense::findOrFail($id);
        $expense->update($validated);
        
        return redirect()->route('expenses.index')
                         ->with('success', 'تم تحديث المصروف بنجاح');
    }
    
    /**
     * Remove the specified expense from storage.
     */
    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
        
        return redirect()->route('expenses.index')
                         ->with('success', 'تم حذف المصروف بنجاح');
    }
}