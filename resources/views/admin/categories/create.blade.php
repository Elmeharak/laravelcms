@extends('layouts.Admin')


@section('content')


    <h1>Create Categories</h1>


    {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store', 'files' => true]) !!}

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

    <div class="row">
        @include('includes.form_error')
    </div>

@stop