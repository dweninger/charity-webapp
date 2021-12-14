@extends('layouts.app')
@section('content')

<h1>Make a Donation to {{$event->name}}</h1>

<form method="POST" action="/events/{{$event->id}}/donate-confirm">
{{method_field('PATCH')}}
{{csrf_field()}}
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputAmount">Amount</label>
      <input type="number" step="0.01" class="form-control" id="inputAmount" name="donation_amount" placeholder="Amount" min="0.01" required>
    </div>
</div>
    <p name='event_id' hidden>{{$event->id}}</p>
    <p name='user_id' hidden>{{ Auth::user()->id }}</p>
  <button type="submit" class="btn btn-primary">Donate!</button>
</form>
@endsection