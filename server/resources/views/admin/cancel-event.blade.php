@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
        <h1>Cancel Event</h1>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Date/Time</th>
                <th>Hours</th>
                <th>Slots</th>
                <th>Donated</th>
                <th>Donation Goal</th>
            </tr>
                <tr>
                    <td name='id'> {{ $event->id }}</td>
                    <td name='description'> {{ $event->name }} </td>
                    <td name='last'> {{ $event->description }} </td>
                    <td name='email'>{{$event->date_time}}</td>
                    <td name='dob'> {{ $event->hours }} </td>
                    <td name='date_joined'> {{ $event->volunteer_slots }} </td>
                    <td name='type'> ${{ $event->donated_amount }} </td>
                    <td name='type'> ${{ $event->donation_goal }} </td>
                </tr>
        </table>
        
        <form method="POST" action="/events/{{$event->id}}/cancel-confirm">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <p name='user_id' hidden>{{ Auth::user()->id }}</p>
            <button type="submit" class="btn btn-danger">Confirm Cancel</button>
        </form>
    </body>
</html>    
@endsection