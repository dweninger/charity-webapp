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
                <th>Donated</th>
                <th>Donation Goal</th>     
                <th></th>
                @auth
                @if(Auth::user()->type == "admin" || Auth::user()->type == "Donor")
                <th></th>
                @endif
                @if(Auth::user()->type == "admin")
                <th></th>
                <th></th>
                @endif
                @endauth
            </tr>
            @foreach($events as $event)
                @if($event->active == true)
                <tr>
                    <td> {{ $event->name }} </td>
                    <td> {{ $event->description }} </td>
                    <td> {{ $event->date_time }} </td>
                    <td> {{ $event->hours }} </td>
                    <td> {{ $event->volunteer_slots }} </td>
                    <td> ${{ $event->donated_amount }} </td>
                    <td> ${{ $event->donation_goal }} </td>
                    @auth
                    {{-- @php($date_facturation = \Carbon\Carbon::parse($event->date_time)) --}}
                    <?php
                        $volunteer_conflict = false;
                        foreach($user_events as $user_event){
                            if($user_event->events_id == $event->id) {
                                if($user_event->status == 'signed_up'){
                                    $volunteer_conflict = true;
                                } 
                            }

                            $event_time = $event->date_time;
                            $event_time_array = explode(" ", $event_time);
                            $event_time_time_array = explode(":", $event_time_array[1]);
                            $event_end_time_hours = intval($event_time_time_array[0]) + $event->hours;

                            $user_event_time = $user_event->date_time;
                            $user_event_time_array = explode(" ", $user_event_time);
                            $user_event_time_time_array = explode(":", $user_event_time_array[1]);
                            
                            if($event_time_array[0] == $user_event_time_array[0]){
                                if(intval($event_time_time_array[0]) <= intval($user_event_time_time_array[0])){
                                    if($event_end_time_hours > intval($user_event_time_time_array[0])){
                                        if($user_event->status == 'signed_up'){
                                            $volunteer_conflict = true;
                                        } 
                                    }
                                }
                            }
                        }

                        $date_facturation = \Carbon\Carbon::parse($event->date_time)
                    ?>
                    

                    <!-- Volunteer Button -->
                    @if($event->volunteer_slots > 0)
                        @if ($date_facturation->isPast())
                            <td class="text-danger font-weight-bold">Past Event</td>
                        @else
                            @if($volunteer_conflict != true)
                                <td><a class="btn btn-primary" href="/events/{{$event->id}}/volunteer" role="button">Volunteer</a></td>
                            @else
                                <td class="text-danger font-weight-bold">Time Conflict</td>
                            @endif
                        @endif
                    @else
                        <td class="text-danger font-weight-bold">Full</td>
                    @endif
                    @endauth
                    @if(Auth::guest())
                    <td></td>
                    @endif
                    
                    <!-- Donate Button -->
                    @auth
                    @if(Auth::user()->type == "admin" || Auth::user()->type == "Donor")
                        @if ($date_facturation->isPast())
                            <td></td>
                        @else
                            <td><a class="btn btn-success" href="/events/{{$event->id}}/donate" role="button">Donate</a></td>
                        @endif
                    @endif

                    <!-- Admin Buttons -->
                    @if(Auth::user()->type == "admin")
                        <td><a class="btn btn-info" href="/events/{{$event->id}}" role="button">Info</a></td>
                        @if ($date_facturation->isPast())
                            <td></td>
                        @else
                            <td><a class="btn btn-danger" href="/events/{{$event->id}}/cancel" role="button">Cancel</a></td>
                        @endif
                    @endif
                    @endauth
                </tr>
                @else
                <tr>
                    <td><del> {{ $event->name }} </del></td>
                    <td><del> {{ $event->description }} </del></td>
                    <td><del> {{ $event->date_time }} </del></td>
                    <td><del> {{ $event->hours }} </del></td>
                    <td><del> {{ $event->volunteer_slots }} </del></td>
                    <td><del> ${{ $event->donated_amount }} </del></td>
                    <td><del> ${{ $event->donation_goal }} </del></td>
                    <td class="text-danger font-weight-bold">Canceled Event</td>
                    @auth
                    @if(Auth::user()->type == "admin" || Auth::user()->type == "Donor")
                    <td></td>
                    @endif
                    @if(Auth::user()->type == "admin")
                    <td></td>
                    <td></td>
                    @endif
                    @endauth
                </tr>
                @endif
            @endforeach
        </table>
        @auth
            @if(Auth::user()->type == "admin")
                <div><a class="btn btn-primary float-right" href="/events/create" role="button">Create Event</a></div>
            @endif
        @endauth
    </body>
</html>
@endsection