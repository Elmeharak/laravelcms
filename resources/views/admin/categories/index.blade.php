@extends('layouts.Admin')


@section('content')


    <h1>Categories</h1>

<table class="table">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Created</th>
            <th>Updated</th>
        </thead>
        <tbody>

            @if($categories)

                @foreach($categories as$key=>$category)

                    <tr>
                        <td>{{$key+1}}</td>
                        <td><a href="{{route('categories.edit', ['id' => $category->cat_id])}}">{{$category->cat_name}}</a></td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>{{$category->updated_at->diffForHumans()}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{url('admin/categories/delete')}}/{{$category->cat_id}}"
                                onclick="return confirm('Are you sure ?')">Delete</a>
                        </td>
                        @if($category->cat_sub == 0)
                         <td>
                             <a class="btn btn-primary" href="{{route('categories.show', ['id' => $category->cat_id])}}">View</a>
                        </td>
                        @endif
                    </tr>

                @endforeach

            @endif

        </tbody>

    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$categories->render()}}
        </div>
    </div>
@stop