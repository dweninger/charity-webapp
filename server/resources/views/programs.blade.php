@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
    <head>
    <title></title>

    
    </head>
    <body>
    
        <h1>Programs</h1>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            @foreach($programs as $program)
                <tr>
                    <td> {{ $program->name }}</td>
                    <td> {{ $program->description }} </td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
@endsection