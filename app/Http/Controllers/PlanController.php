<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::query()->paginate(10);

        return view('plan.index', [
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $validationData = $request->validated();

        try {
            Plan::query()->create($validationData);

            return redirect()->route('plans.index')
                ->with('success', 'Plano cadastrado com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->route('plans.index')
                ->with('error', 'Erro ao cadastrar o plano!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view('plan.edit', [
            'plan' => $plan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $validationData = $request->validated();

        try {
            $plan->update($validationData);

            return redirect()->route('plans.index')
                ->with('success', 'Plano atualizado com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->route('plans.index')
                ->with('error', 'Erro ao atualizar o plano!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        try {
            $plan->delete();

            return redirect()->route('plans.index')
                ->with('success', 'Plano excluído com sucesso!');
        } catch (\Exception $exception) {
            return redirect()->route('plans.index')
                ->with('error', 'Erro ao excluir o plano!');
        }
    }
}