@extends('layouts.Admin')@section('content')    <h1>Countries</h1>    <table class="table">        <thead>        <th>#</th>        <th>Name</th>        <th>Created</th>        <th>Updated</th>        </thead>        <tbody>        @if($governorates)            @foreach($governorates as  $key=>$governorate)                <tr>                    <td>{{$key+1}}</td>                    <td>                        <a href="{{route('governorates.edit', ['id' => $governorate->gov_id])}}">{{$governorate->gov_name}}</a>                    </td>                    <td>{{$governorate->created_at->diffForHumans()}}</td>                    <td>{{$governorate->updated_at->diffForHumans()}}</td>                    <td>                        <a class="btn btn-danger" href="{{url('admin/governorates/delete')}}/{{$governorate->gov_id}}"                           onclick="return confirm('Are you sure ?')">Delete</a>                    </td>            @endforeach        @endif        </tbody>    </table>@stop