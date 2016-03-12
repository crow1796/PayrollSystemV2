@extends('layouts.app', ['title' => 'Add User'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 7.2])
@endsection

@section('content')
    @include('errors.partials._requesterrors')
    <h2 class="page-header">Add User <small>Fill required information.</small></h2>
    
    {!! Form::open(['method' => 'POST', 'url' => url('control-access')]) !!}
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading" title="Click to Show">
                    User Information
                    <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                </div>
                <div class="panel-body panel-body-active">
                    <div class="form-group row">
                        {!! Form::label('username', 'Choose Username: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::text('username', null, ['class' => 'form-control username-control', 'placeholder' => 'Choose Username', 'autocomplete' => 'off']) !!}
                            <div class="username-suggestions-container">
                                {{-- <ul class="nav nav-pills nav-stacked username-suggestions">
                                    <li class="username-suggestion">
                                        <a href="2014-F0092">2014-F0092 <span class="pull-right">Jeral Eng Yacapin</span></a>
                                    </li>
                                </ul> --}}
                            </div>
                            <small>- Username must be based on employee's ID.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('password', 'Password: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Your Password']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('password_confirmation', 'Confirm Password: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::input('password', 'password_confirmation', null, ['class' => 'form-control', 'placeholder' => 'Re-enter Password']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('permission_type', 'Permission Type: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::select('permission_type', $permissionTypes, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Fields
                    <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                </div>
                <div class="panel-body panel-body-active">
                    <button type="submit" class="btn btn-md btn-block btn-primary">Save <span class="fa fa-save"></span></button>
                    <button type="reset" class="btn btn-md btn-block btn-danger">Reset <span class="fa fa-eraser"></span></button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
