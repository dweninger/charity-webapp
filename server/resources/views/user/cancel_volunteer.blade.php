@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
        <h1>Cancel</h1>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Slots</th>
            </tr>
            @foreach($user_events as $user_event)
                <tr>
                    <td name='name'> {{ $user_event->name }}</td>
                    <td name='description'> {{ $user_event->description }} </td>
                    <td name='date'> {{ $user_event->date_time }} </td>
                    <td name='volunteer_slots'> {{ $user_event->volunteer_slots }} </td>
                </tr>
            
        </table>
        
        <form method="POST" action="/user-events/{{$user_event->id}},{{$user_event->user_id}},{{$user_event->event_id}}">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <p name='event_id' hidden>{{$user_event->event_id}}</p>
            <p name='user_id' hidden>{{ Auth::user()->id }}</p>
            <button type="submit" class="btn btn-primary">Confirm Cancelation</button>
        </form>
        @endforeach
    </body>
</html>    
@endsection