@extends('layouts.Admin')@section('content')    @include('includes.form_error')    <h1> Create User</h1>    {!! Form::open(['method' => 'POST', 'action' =>'AdminUsersController@store']) !!}    <div class="form-group">        {{ Form::label('name','Name') }}        {{ Form::text('name', '', [ 'placeholder'=>'Enter Your Name', 'class'=>'form-control' ]) }}    </div>    <div class="form-group">        {{ Form::label('email','Email') }}        {{ Form::email('email', '', [ 'placeholder'=>'Enter Your Email', 'class'=>'form-control' ]) }}    </div>    <div class="form-group">    {!! Form::label('role_id', 'Roles') !!}    {!! Form::select('role_id', ['' => 'choose role'] + $roles, null, ['class' => 'form-control']) !!}    </div>    <div class="form-group">        {{ Form::label('pass','Password') }}        {{ Form::password('pass', [ 'placeholder'=>'Enter Your Password', 'class'=>'form-control' ]) }}    </div>    <div class="form-group">        {{ Form::submit('Save', ['class'=>'btn btn-primary']) }}    </div>    {!! Form::close()  !!}@stop