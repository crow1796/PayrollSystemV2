@extends('layouts.app', ['title' => 'Create Employees DTR - Manual'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 3.3])
@endsection

@section('content')

    <h2 class="page-header">
        Create Employees DTR <small>Manual</small>
        <a href="{{ url('payroll/dtr/import') }}" class="btn btn-xs btn-danger">
            Import Excel/CSV
        </a>
    </h2>

    <div class="row">
        <div class="col-sm-8">
        	<div class="transaction-settings-container">
        		
        	</div>
			<div class="bmpc-table-container">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th class="min-tablet-p">Position</th>
							<th class="min-tablet-p">Department</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($employees as $employee)
							<tr>
								<td>
								<a href="" data-employee_id="{{ $employee->id }}" data-fullname="{{ $employee->fullname }}" data-position="{{ $employee->position->name }}" data-department="{{ $employee->department->name }}" class="start-payroll-transact-button">{{ $employee->id }} &raquo;</a>
								</td>
								<td>{{ $employee->fullname }}</td>
								<td>
									{{ $employee->position->name }}
								</td>
								<td>
									{{ $employee->department->name }}
								</td>
								<td>
									{{ $employee->active ? 'Active' : 'Not Active' }}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
        </div>
        {{-- /.col-sm-8 --}}
        <div class="col-sm-4">
        	<div class="panel panel-default dtr-transaction-container">
    			<div class="panel-heading">
                    DTR Form
                    <span class="pull-right"><span class="fa fa-caret-up"></span></span>
                </div>
                {{-- /.panel-heading --}}
        		<div class="panel-body dtr-transaction">
        			{!! Form::open(['method' => 'POST', 'url' => '#']) !!}
        				<div class="form-group row">
        					{!! Form::label('for_date', 'For Date: ', ['class' => 'control-label col-sm-4']) !!}
        					<div class="col-sm-8">
        						{!! Form::text('for_date', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'input-date form-control']) !!}
        					</div>
        				</div>
        				<div class="form-group row transact-employee-information">
        					<div class="col-sm-12">
        						<p><b>Employee ID: </b><span class="pull-right" id="transact-employee-id"></span></p>
        						<p><b>Full Name: </b><span id="transact-fullname" class="pull-right"></span></p>
        						<p><b>Position: </b><span id="transact-position" class="pull-right"></span></p>
        						<p><b>Department: </b><span id="transact-department" class="pull-right"></span></p>
        					</div>
        				</div>
        				<div class="form-group row">
        					{!! Form::label('time_in', 'Time In: ', ['class' => 'control-label col-sm-4']) !!}
        					<div class="col-sm-8">
        						{!! Form::input('number', 'time_in', null, ['class' => 'form-control', 'placeholder' => 'Time In']) !!}
        					</div>
        				</div>
        				<div class="form-group row">
        					{!! Form::label('time_out', 'Time Out: ', ['class' => 'control-label col-sm-4']) !!}
        					<div class="col-sm-8">
        						{!! Form::input('number', 'time_out', null, ['class' => 'form-control', 'placeholder' => 'Time Out']) !!}
        					</div>
        				</div>
        				<div class="form-group row">
        					<div class="col-sm-12">
        						<p><b>Regular Hours: </b><span class="pull-right" id="regular-hours"></span></p>
        						<p><b>Undertime Hours: </b><span class="pull-right" id="undertime-hours"></span></p>
        						<p><b>Overtime Hours: </b><span class="pull-right" id="overtime-hours"></span></p>
        						<p><b>Total Hours: </b><span class="pull-right" id="total-hours"></span></p>
        					</div>
        				</div>
        				<div class="form-group row">
        					<div class="col-sm-12 text-right">
        						<button type="reset" class="btn btn-warning btn-md">Reset</button>
        						<button type="submit" class="btn btn-danger btn-md">Save</button>
        					</div>
        				</div>
        			{!! Form::close() !!}
        		</div>
                {{-- /.panel-body --}}
        	</div>
            {{-- /.panel --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}
@include('partials._message')
@endsection
