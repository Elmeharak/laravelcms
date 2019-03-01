@extends('layouts.Admin')


@section('content')


    <h1>Sub Categories</h1>

<table class="table">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
        </thead>
        <tbody>

            @if($categories)

                @foreach($categories as $category)

                    <tr>
                        <td>{{$category->cat_id}}</td>
                        <td><a href="{{route('categories.edit', ['id' => $category->cat_id])}}">{{$category->cat_name}}</a></td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>{{$category->updated_at->diffForHumans()}}</td>
                         <td>

                           {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->cat_id]]) !!}

                              {!! Form::submit('Delete', ['class' => 'btn btn-danger col-sm-6']) !!}

                             {!! Form::close() !!}
                        </td>
                       
                    </tr>

                @endforeach

            @endif

        </tbody>
    </table>
@stop