@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
    
        <h1>My Donations</h1>
        <table class="table table-striped">
            <tr>
                <th>Amount</th>
                <th>Event</th>
                <th>Restricted</th>
                <th>Timestamp</th>
            </tr>
            @foreach($user_events as $user_event)
            @if($user_event->donation_amount > 0)
                <tr>
                    <td> ${{ $user_event->donation_amount }}</td>
                    <td> {{ $user_event->name }} </td>
                    <td> Restricted </td>
                    <td>{{ $user_event->date }}</td>
                </tr>
            @endif
            @endforeach
            @foreach($u_donations as $u_donation)
                <tr>
                    <td>${{ $u_donation->donation_amount }}</td>
                    <td>-</td>
                    <td>Unrestricted</td>
                    <td>{{ $u_donation->date }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
@endsection