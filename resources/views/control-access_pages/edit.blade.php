@extends('layouts.app', ['title' => 'Add User'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 7])
@endsection

@section('content')
    @include('errors.partials._requesterrors')
    <h2 class="page-header">Edit User <small>Fill required information.</small></h2>
    
    {!! Form::model($user, ['method' => 'PUT', 'url' => url('/control-access', $user->id)]) !!}
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading" title="Click to Show">
                    User Information
                    <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                </div>
                <div class="panel-body panel-body-active">
                    <div class="form-group row">
                        {!! Form::label('username', 'Username: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {{ $user->username }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('fullname', 'Fullname: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {{ $user->fullname }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('position', 'Position: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {{ $user->employmentInformation->position->name }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('department', 'Department: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {{ $user->employmentInformation->department->name }}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('password', 'New Password: ', ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-9">
                            {!! Form::input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Your New Password']) !!}
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
                            {!! Form::select('permission_type', $permissionTypes, $user->permission_id, ['class' => 'form-control']) !!}
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
