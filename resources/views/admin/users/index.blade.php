@extends('layouts.Admin')


@section('content')

    <div class="ajax"></div>

    <h1>Users</h1>
 <table class="table">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created</th>
            <th>Updated</th>
        </thead>
        <tbody>

            @if($users)

                @foreach($users as $user)

                    <tr class="user-{{$user->user_id}}">
                        <td>{{$user->user_id}}</td>
                        <td><a href="#">{{$user->user_name}}</a></td>
                        <td>{{$user->user_email}}</td>
                        <td>{{@$user->role->role_name ?? 'no role'}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                        <td>
                            <a class="btn btn-danger fas fa-trash-alt removeCat" data-id="{{$user->user_id}}"></a>
                        </td>
                        <td>
                            <a class="btn btn-primary fas fa-user-edit" href="{{route('users.edit', ['id' => $user->user_id])}}"></a>
                        </td>
                    </tr>

                @endforeach

            @endif

        </tbody>
    </table>


    {{--delete categories by ajax--}}
    <script>
        $(function () {
            $('.removeCat').click(function () {
                if( !confirm('Confirm Delete ?') )
                    return false;

                var id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url: '{{action('AdminUsersController@deleteUser')}}',
                    method: 'POST',
                    data: {user_id: id}
                }).done(function (response) {
                    var data = $.parseJSON(response);
                    if (data.status == 1) {
                        $('tr.user-'+id).fadeOut(800);
                        $('.ajax').html(data.message)
                    }
                })
                return false;
            })
        })
    </script>
@stop