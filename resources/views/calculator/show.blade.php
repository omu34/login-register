@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Asset Finance Calculator</h1>
        <form method="POST" action="{{ route('asset-finance-calculator') }}">
            @csrf

            <div class="form-group">
                <label for="asset_cost">Asset Cost:</label>
                <input type="number" name="asset_cost" id="asset_cost" required min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="down_payment">Down Payment:</label>
                <input type="number" name="down_payment" id="down_payment" required min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="term_length">Term Length (months):</label>
                <input type="number" name="term_length" id="term_length" required min="1" step="1">
            </div>

            <div class="form-group">
                <label for="interest_rate">Interest Rate (%):</label>
                <input type="number" name="interest_rate" id="interest_rate" required min="0" step="0.01">
            </div>

            <div class="form-group">
                <label for="balloon_payment">Balloon Payment (optional):</label>
                <input type="number" name="balloon_payment" id="balloon_payment" min="0" step="0.01">
            </div>

            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
    </div>
@endsection

