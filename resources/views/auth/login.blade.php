@extends('layouts.app', ['title' => 'Login | BMP Payroll System', 'noSidebarNav' => false])

@section('content')

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4" id="login-form-container">
            <a href="{{ url('/') }}" title="BMPC Payroll System" class="login-form-logo">
                <img src="{{ url('images/bmpc_logo.png') }}" alt="BMPC" class="center-block img-responsive">
            </a>

            {!! Form::open(['method' => 'POST', 'url' => url('/login')]) !!}
                <div class="form-group">
                    {!! Form::label('username', 'Username: ') !!}
                    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter your username']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password: ') !!}
                    {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Enter your password']) !!}
                </div>
                <div class="form-group text-center">
                    {!! Form::submit('LOGIN', ['class' => 'btn btn-md btn-primary btn-block']) !!}
                </div>
                @include('errors.partials._requesterrors')
            {!! Form::close(); !!}

        </div>
    </div>

@endsection
