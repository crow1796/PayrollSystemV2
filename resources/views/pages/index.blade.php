@extends('layouts.app', ['title' => 'Home'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 1])
@endsection

@section('content')
@include('errors.partials._requesterrors')
<h2 class="page-header">Features</h2>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="text-center page-header">
            Employee Management
            <a href="{{ url('/employees') }}" class="btn btn-xs btn-primary pull-right">
                Go <span class="fa fa-arrow-right"></span>
            </a>
        </h3>
        <img src="images/employee-management.png" alt="" class="center-block img-responsive">
        <p class="text-center">Allows user to View, Add, Edit, Delete Employee Info and Set Salaries.</p>
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-xs-12">
        <h3 class="text-center page-header">
            Payroll Transaction
            <a href="{{ url('/payroll') }}" class="btn btn-xs btn-primary pull-right">
                Go <span class="fa fa-arrow-right"></span>
            </a>
        </h3>
        <img src="images/payroll-transaction.png" alt="" class="center-block img-responsive">
        <p class="text-center">Allows user to view employee work details and compute its salary deduction.</p>
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-xs-12">
        <h3 class="text-center page-header">
            Calendar
            <a href="{{ url('/calendar') }}" class="btn btn-xs btn-primary pull-right">
                Go <span class="fa fa-arrow-right"></span>
            </a>
        </h3>
        <img src="images/holiday.png" alt="" class="center-block img-responsive">
        <p class="text-center">Allows user to set Holidays (Special or Non-working Holidays).</p>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-4 col-xs-12 col-sm-offset-2">
        <h3 class="text-center page-header">
            Reports
            <a href="{{ url('/reports/all') }}" class="btn btn-xs btn-primary pull-right">
                Go <span class="fa fa-arrow-right"></span>
            </a>
        </h3>
        <img src="images/leave.png" alt="" class="center-block img-responsive">
        <p class="text-center">Allows user to view and print payroll. Withholding TAX, SSS, PhilHealth etc. reports of all the employee.</p>
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-xs-12">
        <h3 class="text-center page-header">
            Control Access
            <a href="{{ url('/control-access') }}" class="btn btn-xs btn-primary pull-right">
                Go <span class="fa fa-arrow-right"></span>
            </a>
        </h3>
        <img src="images/control-access.png" alt="" class="center-block img-responsive">
        <p class="text-center">Allows user to add a new user account, and assign accessible pages for a user.</p>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->


@endsection
