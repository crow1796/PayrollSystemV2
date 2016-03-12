@extends('layouts.app', ['title' => 'Create Employees DTR - Import Excel/CSV Files'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 3.3])
@endsection

@section('content')

    <h2 class="page-header">
        Create Employees DTR <small>Import Excel/CSV Files</small>
        <a href="{{ url('payroll/dtr/manual') }}" class="btn btn-xs btn-danger">
            Create DTR Manually
        </a>
    </h2>

    <div class="row">
        {!! Form::open(['method' => 'POST', 'url' => url('/payroll/dtr/import/uploading'), 'files' => true]) !!}
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Import Files
                    </div>
                    <div class="panel-body panel-body-active">
                        <div class="form-group row">
                            <div class="col-sm-12 multiple-file-input-container">
                                {!! Form::input('file', 'excel_csv[]', null, ['multiple', 'required', 'accept' => '.csv,.xlsx', 'id' => 'excel_csv']) !!}
                                <label for="excel_csv">
                                    <span class="fa fa-upload"></span>
                                    <span class="file-count">Choose a file</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Fields
                    </div>
                    <div class="panel-body panel-body-active">
                        <button type="submit" class="btn btn-md btn-primary btn-block">Save <span class="fa fa-save"></span></button>
                        <button type="reset" class="btn btn-md btn-danger btn-block">Reset <span class="fa fa-eraser"></span></button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>

@endsection
