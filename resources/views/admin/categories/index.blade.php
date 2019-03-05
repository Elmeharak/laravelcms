@extends('layouts.Admin')


@section('content')

    <div class="ajax"></div>

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

                    <tr class="cat-{{$category->cat_id}}">
                        <td>{{$key+1}}</td>
                        <td><a href="{{route('categories.edit', ['id' => $category->cat_id])}}">{{$category->cat_name}}</a></td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>{{$category->updated_at->diffForHumans()}}</td>
                        {{--<td>--}}
                            {{--<a class="btn btn-danger" href="{{url('admin/categories/delete')}}/{{$category->cat_id}}"--}}
                                {{--onclick="return confirm('Are you sure ?')">Delete</a>--}}
                        {{--</td> --}}
                        <td>
                            <a class="btn btn-danger fas fa-trash-alt removeCat" data-id="{{$category->cat_id}}"></a>
                        </td>
                        @if($category->cat_sub == 0)
                         <td>
                             <a class="btn btn-primary far fa-eye" href="{{route('categories.show', ['id' => $category->cat_id])}}"></a>
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

{{--delete categories by ajax--}}
    <script>
        $(function () {
            $('.removeCat').click(function () {
                if( !confirm('Confirm Delete ?') )
                    return false;

                var id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url: '{{action('AdminCategoriesController@deleteCat')}}',
                    method: 'POST',
                    data: {cat_id: id}
                }).done(function (response) {
                    var data = $.parseJSON(response);
                    if (data.status == 1) {
                        $('tr.cat-'+id).fadeOut(800);
                        $('.ajax').html(data.message)
                    }
                })
                return false;
            })
        })
    </script>

@stop