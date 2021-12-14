@extends('layouts.app')

@section('content')
<h1>Create New Program</h1>

<form method="POST" action="/programs">
{{ csrf_field() }}
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" name="name" placeholder="Program name" required>
    </div>
    <div class="form-group col-md-6">
    <label for="inputDescription">Description</label>
    <input type="text" class="form-control" id="inputDescription" name="description" placeholder="Event details" required>
  </div>
  </div>
  <div class="form-row">
  
  
  <div class="form-group col-md-3">
    <label for="inputVolunteerSlots">Total Volunteers</label>
    <input type="number" class="form-control" id="inputVolunteerSlots" name="total_volunteers" placeholder="0" min="0" required>
  </div>
  <div class="form-group col-md-3">
    <label for="inputDonatedAmount">Donation Amount</label>
    <input type="number" step="0.01" class="form-control" id="inputDonatedAmount" name="total_donations" placeholder="0.00" min="0.00" required>
  </div>
  <div class="form-group col-md-3">
        <label for="inputDateCreated">Program Created On</label>
        <input type="date" class="form-control" id="inputDateCreated" name="date_created" value="<?=date("Y-m-d") ?>" min="<?=date("Y-m-d") ?>" max="<?=date("Y-m-d") ?>">
    </div>
</div>
  <button type="submit" class="btn btn-primary">Create Program</button>
</form>
@endsection