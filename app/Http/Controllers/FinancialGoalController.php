<?php

namespace App\Http\Controllers;

use App\Models\FinancialGoal;
use Illuminate\Http\Request;

class FinancialGoalController extends Controller
{
    public function index()
    {
        $goals = auth()->user()->financialGoals ?? collect(); 
        return view('financial.index', compact('goals'));
    }

    public function create()
    {
        return view('financial.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $validated['user_id'] = auth()->id();

        FinancialGoal::create($validated);

        return redirect()->route('financial.index')->with('success', 'Meta criada com sucesso!');
    }

    public function show(FinancialGoal $financialGoal)
    {
        $this->authorize('view', $financialGoal);

        return view('financial.show', compact('financialGoal'));
    }

    public function update(Request $request, FinancialGoal $financialGoal)
    {
        $this->authorize('update', $financialGoal);

        $validated = $request->validate([
            'saved_amount' => 'required|numeric|min:0|max:' . $financialGoal->target_amount,
        ]);

        $financialGoal->update($validated);

        return redirect()->route('financial.index')->with('success', 'Meta atualizada!');
    }

    public function destroy(FinancialGoal $financialGoal)
    {
        $this->authorize('delete', $financialGoal);

        $financialGoal->delete();

        return redirect()->route('financial.index')->with('success', 'Meta removida!');
    }
}
