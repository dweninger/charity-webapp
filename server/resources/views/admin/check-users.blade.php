@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
    
        <h1>Users</h1>
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
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td> {{ $user->id }} </td>
                    <td> {{ $user->first }} </td>
                    <td> {{ $user->last }} </td>
                    <td> {{ $user->email }} </td>
                    <td> {{ $user->dob }} </td>
                    <td> {{ $user->date_joined }} </td>
                    <td> {{ $user->type }} </td>
                    @if($user->active == true)
                    <td>Y</td>
                    @else
                    <td>N</td>
                    @endif
                    <td><a class="btn btn-primary" href="/users" role="button">Edit</a></td>
                    <td><a class="btn btn-info" href="/users/{{$user->id}}" role="button">Stats</a></td>
                    @if($user->active == true)
                    <td><a class="btn btn-danger" href="/users/{{$user->id}}/deactivate" role="button">Deactivate</a></td>
                    @else
                    <td><a class="btn btn-success" href="/users/{{$user->id}}/activate" role="button">Activate</a></td>
                    @endif
                </tr>
            @endforeach
        </table>
    </body>
</html>
@endsection