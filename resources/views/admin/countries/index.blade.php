@extends('layouts.Admin')


@section('content')


    <h1>Countries</h1>

 <table class="table">
        <thead>
            <th>#</th>
            <th>Country Flag</th>
            <th>Name</th>
            <th>Code</th>
            <th>Created</th>
            <th>Updated</th>
        </thead>
        <tbody>

            @if($countries)

                @foreach($countries as $key=>$country)

                    <tr>
                        <td>{{$key +1}}</td>
                        <td>    <img src="{{url('images/country')}}/{{$country->country_flag}}" height="40px" alt=""></td>
                        <td><a href="{{route('countries.edit', ['id' => $country->country_id])}}">{{$country->country_name}}</a></td>
                        <td>{{$country->country_code}}</td>
                        <td>{{$country->created_at->diffForHumans()}}</td>
                        <td>{{$country->updated_at->diffForHumans()}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{url('admin/countries/delete')}}/{{$country->country_id}}"
                               onclick="return confirm('Are you sure ?')">Delete</a>
                        </td>
                        {{--@if($country->gov == 0)--}}
                            <td>
                                <a class="btn btn-primary" href="{{route('countries.show', ['id' => $country->country_id])}}">View</a>
                            </td>
                        {{--@endif--}}
                    </tr>

                @endforeach

            @endif

        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$countries->render()}}
        </div>
    </div>
@stop