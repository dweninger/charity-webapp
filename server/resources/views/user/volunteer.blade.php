@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
        <h1>Events</h1>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Hours</th>
                <th>Slots</th>
            </tr>
                <tr>
                    <td name='name'> {{ $event->name }}</td>
                    <td name='description'> {{ $event->description }} </td>
                    <td name='date'> {{ $event->date_time }} </td>
                    <td name='hours'>{{$event->hours}}</td>
                    <td name='volunteer_slots'> {{ $event->volunteer_slots }} </td>
                </tr>
        </table>
        
        <form method="POST" action="/events/{{$event->id}}/volunteer-confirm">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <p name='event_id' hidden>{{$event->id}}</p>
            <p name='user_id' hidden>{{ Auth::user()->id }}</p>
            <p name='volunteer_hours' hidden>{{$event->hours}}</p>
            <button type="submit" class="btn btn-primary">Confirm Volunteer</button>
        </form>
    </body>
</html>    
@endsection