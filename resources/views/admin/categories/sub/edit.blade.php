
@extends('layouts.Admin')


@section('content')


 <h1>edit sub Categories</h1>


{!! Form::model($category,['method' => 'PATCH', 'action' => ['AdminCategoriesController@updatesub', $category->cat_id]]) !!}

        <div class="form-group">
            {!! Form::label('cat_name', 'Name') !!}
            {!! Form::text('cat_name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">

            {!! Form::submit('Create Categories', ['class' => 'btn btn-primary']) !!}

        </div>

    {!! Form::close() !!}

    @stop