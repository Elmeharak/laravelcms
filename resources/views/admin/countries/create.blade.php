0

@extends('layouts.Admin')


@section('content')


    <h1>Create Countries</h1>


    {!! Form::open(['method' => 'POST', 'action' => 'AdminCountriesController@store', 'files' => true]) !!}

    <div class="form-group">
        {!! Form::label('country_name', 'Name') !!}
        {!! Form::text('country_name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('country_code', 'Country Code') !!}
        {!! Form::text('country_code', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('image','Image') !!}
        {!! Form::file('image',['class' =>'form-control']) !!}
    </div>

    <div class="form-group">

        {!! Form::submit('Create Countries', ['class' => 'btn btn-primary']) !!}

    </div>

    {!! Form::close() !!}

    <div class="row">
        @include('includes.form_error')
    </div>
@stop