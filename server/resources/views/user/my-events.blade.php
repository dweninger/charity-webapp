@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
    
        <h1>My Volunteer Appointments</h1>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Hours</th>
                <th>Cancel</th>
            </tr>
            @foreach($user_events as $user_event)
                @if($user_event->status =='signed_up')
                <tr>
                    <td> {{ $user_event->name }}</td>
                    <td> {{ $user_event->description }} </td>
                    <td> {{ $user_event->date_time }} </td>
                    <td> {{ $user_event->hours }} </td>
                    @if($user_event->status == 'signed_up')
                    <td><a class="btn btn-primary" href="/user-events/{{$user_event->id}},{{$user_event->user_id}},{{$user_event->event_id}}/edit" role="button">Cancel</a></td>
                    @endif
                </tr>
                @endif
                @if($user_event->status == 'cancelled')
                <tr>
                    <td><del>{{ $user_event->name }}</del></td>
                    <td><del>{{ $user_event->description }}</del></td>
                    <td><del>{{ $user_event->date_time }}</del></td>
                    <td><del>{{ $user_event->hours }}</del></td>
                    <td class="text-danger font-weight-bold">Cancelled</td>
                </tr>
                @endif
            @endforeach
        </table>
    </body>
</html>
@endsection