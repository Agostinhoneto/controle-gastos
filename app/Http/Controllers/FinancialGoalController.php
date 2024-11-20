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
        $financialGoal = new FinancialGoal();
        $financialGoal->nome = $request->input('nome');
        $financialGoal->valor = $request->input('valor');
        $financialGoal->start_date = $request->input('start_date');
        $financialGoal->end_date = $request->input('end_date');
        $financialGoal->user_id = auth()->id();

        $financialGoal->save();

   // FinancialGoal::create($validated);

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
