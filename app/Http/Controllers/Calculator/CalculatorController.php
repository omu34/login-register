<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function calculate(Request $request)
    {
        $validatedData = $request->validate([
            'asset_cost' => 'required|numeric',
            'down_payment' => 'required|numeric',
            'term_length' => 'required|numeric',
            'interest_rate' => 'required|numeric',
            'balloon_payment' => 'nullable|numeric',
        ]);

        // Calculate loan amount, monthly interest rate, and apply appropriate formula
        $loanAmount = $validatedData['asset_cost'] - $validatedData['down_payment'];
        $monthlyInterestRate = $validatedData['interest_rate'] / 1200; // Convert to decimal

        // Use appropriate formula based on asset finance type (HP, LP, Finance Lease)
        $monthlyPayment = calculateMonthlyPayment($loanAmount, $monthlyInterestRate, $validatedData['term_length'], $validatedData['balloon_payment'] ?? null);

        // Calculate total interest, total cost, and other metrics
        $totalInterest =++;
        $totalCost =;

        return view('calculateResults', compact('monthlyPayment', 'totalInterest', 'totalCost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
