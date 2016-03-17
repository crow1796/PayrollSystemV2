@extends('layouts.app', ['title' => 'Edit Employee Rates'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 2])
@endsection

@section('content')
    @include('errors.partials._requesterrors')
    <a href="{{ url('/employees') }}" class="btn btn-link btn-xs">&laquo; Back</a>
    <h2 class="page-header">
        Edit Employee Rates
        {{-- <a href="{{ url('payroll/create') }}" class="">
            New Transaction
        </a> --}}
    </h2>
    <div class="row">
        {!! Form::model($employeeRates, ['method' => 'PUT', 'url' => url('/employees/' . $employee->id . '/update-rates')]) !!}
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Rates
                    </div>
                    <div class="panel-body panel-body-active">
                        @for($i = 0; $i < count($rateKeys); $i++)
                            <div class="form-group row">
                                {!! Form::label($rateKeys[$i], $rateNames[$i], ['class' => 'col-sm-3 control-label']) !!}
                                {{-- /label --}}
                                <div class="col-sm-9">
                                    {!! Form::text($rateKeys[$i], null, ['class' => 'form-control']) !!}
                                </div>
                                {{-- /.form-control --}}
                            </div>
                            {{-- /.row --}}
                        @endfor
                    </div>
                </div>
            </div>
            {{-- /.col-8 --}}
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
            {{-- /.col-4 --}}
        {!! Form::close() !!}
    </div>
@endsection