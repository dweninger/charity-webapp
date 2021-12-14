@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
        <h1>Deactivate User</h1>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
                <th>DOB</th>
                <th>Date Joined</th>
                <th>Type</th>
            </tr>
                <tr>
                    <td name='id'> {{ $user->id }}</td>
                    <td name='description'> {{ $user->first }} </td>
                    <td name='last'> {{ $user->last }} </td>
                    <td name='email'>{{$user->email}}</td>
                    <td name='dob'> {{ $user->dob }} </td>
                    <td name='date_joined'> {{ $user->date_joined }} </td>
                    <td name='type'> {{ $user->type }} </td>
                </tr>
        </table>
        
        <form method="POST" action="/users/{{$user->id}}/deactivate-confirm">
            {{method_field('PATCH')}}
            {{csrf_field()}}
            <p name='user_id' hidden>{{ Auth::user()->id }}</p>
            <button type="submit" class="btn btn-danger">Confirm Deactivate</button>
        </form>
    </body>
</html>    
@endsection