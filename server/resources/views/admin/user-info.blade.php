@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
    
        <h1>{{$user->first}} {{$user->last}}</h1>

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Date Joined</th>
                <th>Type</th>
                <th>Active</th>
                <th>Volunteer Hours</th>
                @if(Auth::user()->type  == "donor" || Auth::user()->type == "admin")
                <th>Total Donated</th>
                @endif
            </tr>
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->first }}</td>
                <td>{{ $user->last }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->date_joined }}</td>
                <td>{{ $user->type }}</td>
                @if($user->active == true)
                <td>Y</td>
                @else
                <td>N</td>
                @endif

                <?php
                    $total_hours = 0;
                    $total_donation = 0;

                    foreach($user_events as $user_event){
                        if($user_event->status != 'cancelled'){
                            $total_hours += $user_event->hours;
                        }
                        $total_donation += $user_event->donation_amount;
                    }

                    foreach($u_donations as $u_donation){
                        $total_donation += $u_donation->donation_amount;
                    }
                ?>

                <td>{{$total_hours}}</td>
                @if(Auth::user()->type  == "donor" || Auth::user()->type == "admin")
                <td>${{$total_donation}}</td>
                @endif
            </tr>
        </table>
        <h3>Volunteering Stats</h3>
        <table class="table table-striped">
            <tr>
                <th>Event ID</th>
                <th>Event</th>
                <th>Description</th>
                <th>Date</th>
                <th>Hours</th>
                <th>Slots</th>
                <th></th>
            </tr>
            @foreach($user_events as $event)
            @if($event->status != 'cancelled')
            <tr>
                <td>{{$event->event_id}}</td>
                <td>{{$event->name}}</td>
                <td>{{$event->description}}</td>
                <td>{{$event->date_time}}</td>
                <td>{{$event->hours}}</td>
                <td>{{$event->volunteer_slots}}</td>
                <td></td>
            </tr>
            @else
            <tr>
                <td><del>{{$event->event_id}}</del></td>
                <td><del>{{$event->name}}</del></td>
                <td><del>{{$event->description}}</del></td>
                <td><del>{{$event->date_time}}</del></td>
                <td><del>{{$event->hours}}</del></td>
                <td><del>{{$event->volunteer_slots}}</del></td>
                <td class="text-danger font-weight-bold">Cancelled Event</td>
            </tr>
            @endif
            @endforeach
        </table>

        @auth
        @if(Auth::user()->type  == "donor" || Auth::user()->type == "admin")
        <h3>Unrestricted Donation Stats</h3>
        <table class="table table-striped">
            <tr>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            @foreach($u_donations as $u_donation)
            <tr>
                <td>${{$u_donation->donation_amount}}</td>
                <td>{{$u_donation->date}}</td>
            </tr>
            @endforeach
        </table>
        <h3>Restricted Donation Stats</h3>
        <table class="table table-striped">
            <tr>
                <th>Amount</th>
                <th>Event</th>
                <th>Date</th>
            </tr>
            @foreach($user_events as $event)
            @if($event->donation_amount > 0)
            <tr>
                <td>${{$event->donation_amount}}</td>
                <td>{{$event->name}}</td>
                <td>{{$event->date}}</td>
            </tr>
            @endif
            @endforeach
        </table>
        @endif
        @endauth
    </body>
</html>
@endsection