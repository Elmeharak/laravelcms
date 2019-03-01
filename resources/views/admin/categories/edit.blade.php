@extends('layouts.Admin')


@section('content')


    <h1>edit Categories</h1>


    {!! Form::model($category,['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->cat_id]]) !!}

    <div class="form-group">
        {!! Form::label('cat_name', 'Name') !!}
        {!! Form::text('cat_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('cat_sub', 'Categories') !!}
        {!! Form::select('cat_sub', ['0' => 'Main Categories'] + $categories, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">

        {!! Form::submit('Create Categories', ['class' => 'btn btn-primary']) !!}

    </div>

    {!! Form::close() !!}

@stop