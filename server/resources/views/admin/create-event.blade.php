@extends('layouts.app')
@section('content')

<h1>Create New Event</h1>

<form method="POST" action="/events">
  {{ csrf_field() }}
  <div class="form-row">
    <!-- <div class="form-group col-md-4">
      <label for="inputProgram">Program</label>
      <input type="text" class="form-control" id="inputProgram" name="program" placeholder="Program">
    </div> -->
    <div class="form-group col-md-4">
      <label for="inputName">Name</label>
      <input type="text" class="form-control" id="inputName" name="name" placeholder="Event Name" required>
    </div>

  <div class="form-group col-md-5">
    <label for="inputDescription">Description</label>
    <input type="text" class="form-control" id="inputDescription" name="description" placeholder="Event details" required>
  </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputVolunteerSlots">Volunteer Slots</label>
      <input type="number" class="form-control" id="inputVolunteerSlots" name="volunteer_slots" placeholder="How many volunteers do we need?" min="1" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputDonatedAmount">Donation Amount</label>
      <input type="number" step="0.01" class="form-control" id="inputDonatedAmount" name="donated_amount" placeholder="How much has been donated?" min="0.00" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputDonationGoal">Donation Goal</label>
      <input type="number" step="0.01" class="form-control" id="inputDonationGoal" name="donation_goal" placeholder="How much should be donated?" min="0.01" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputDateCreated">Event Created On</label>
      <input type="date" class="form-control" id="inputDateCreated" name="date_created" value="<?= date("Y-m-d") ?>" min="<?= date("Y-m-d") ?>" max="<?= date("Y-m-d") ?>" required>
    </div>

    <div class="form-group col-md-3">
      <label for="inputDate">Event Takes Place On</label>
      <input type="datetime-local" class="form-control" id="inputDate" name="date_time" value="<?= date('Y-m-d\T00:00:00') ?>" min="<?= date('Y-m-d\T00:00:00') ?>" required>
    </div>
    <div class="form-group col-md-3">
      <label for="inputHours">Hours</label>
      <input type="number" class="form-control" id="inputHours" name="hours" placeholder="How many hours is this event?" min="1" required>
    </div>
  </div>


  <button type="submit" class="btn btn-primary">Create Event</button>
</form>
@endsection