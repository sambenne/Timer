@extends('master')

@section('content')
    <h2>Timer Login/Register</h2>
    <div class="row">
        <div class="login col-md-6">
            {{ Form::open(['url' => 'login', 'class'=>'form-signin', 'method' => 'POST']) }}
            <p>
                {{ $errors->first('email') }}
                {{ $errors->first('password') }}
            </p>
                {{ Form::text('email', null, ['placeholder' => 'Email', 'class'=> 'form-control', 'required' => 'required', 'autofocus' => 'autofocus' ]) }}
                {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required']) }}
                {{ Form::submit('Sign in', ['class' => 'btn btn-lg btn-primary btn-block']) }}
            {{ Form::close() }}
        </div>
        <div class="register col-md-6">
            {{ Form::open(['url' => 'register', 'class'=>'form-signin', 'method' => 'POST']) }}
            {{ Form::text('name', null, ['placeholder' => 'Name', 'class'=> 'form-control', 'required' => 'required', 'autofocus' => 'autofocus' ]) }}
            {{ Form::text('email', null, ['placeholder' => 'Email', 'class'=> 'form-control', 'required' => 'required', 'autofocus' => 'autofocus' ]) }}
            {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'required' => 'required']) }}
            {{ Form::submit('Register', ['class' => 'btn btn-lg btn-primary btn-block']) }}
            {{ Form::close() }}
        </div>
    </div>
@stop