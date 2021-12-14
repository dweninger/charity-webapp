@extends('layouts.app')
@section('content')

<h1>Make an Unrestricted Donation</h1>

<form method="POST" action="/unrestricted-donations">
{{ csrf_field() }}
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputAmount">Amount</label>
      <input type="number" step="0.01" class="form-control" id="inputAmount" name="donation_amount" placeholder="Amount" min="0.01" required>
    </div>
</div>
  
  <button type="submit" class="btn btn-primary">Donate!</button>
</form>
@endsection