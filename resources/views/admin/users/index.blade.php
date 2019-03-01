@extends('layouts.Admin')


@section('content')


    <h1>Users</h1>
 <table class="table">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created</th>
            <th>Updated</th>
        </thead>
        <tbody>

            @if($users)

                @foreach($users as $user)

                    <tr>
                        <td>{{$user->user_id}}</td>
                        <td><a href="#">{{$user->user_name}}</a></td>
                        <td>{{$user->user_email}}</td>
                        <td>{{$user->user_phone}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>

                @endforeach

            @endif

        </tbody>
    </table>


@stop