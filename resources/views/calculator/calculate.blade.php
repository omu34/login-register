@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Asset Finance Calculator Results</h1>

        @if ($monthlyPayment)
            <p>Monthly Payment: {{ number_format($monthlyPayment, 2) }}</p>
        @endif

        @if ($totalInterest)
            <p>Total Interest Paid: {{ number_format($totalInterest, 2) }}</p>
        @endif

        @if ($totalCost)
            <p>Total Cost of Ownership: {{ number_format($totalCost, 2) }}</p>
        @endif
    </div>
@endsection

