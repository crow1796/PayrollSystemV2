@extends('layouts.app', ['title' => 'Add Holiday'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 4.2])
@endsection

@section('content')
	@include('errors.partials._requesterrors')
    <h2 class="page-header">Add Holiday/Event</h2>
	<div class="row">
		{!! Form::open(['method' => 'POST', 'url' => url('/calendar')]) !!}
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						Event Information
						<span class="pull-right"><span class="fa fa-caret-up"></span></span>
					</div>
					<div class="panel-body panel-body-active">
						<div class="form-group row">
							{!! Form::label('event_name', 'Event Name:* ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_name', null, ['class' => 'form-control', 'placeholder' => 'Event or Holiday Name']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_location', 'Event Location: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_location', null, ['class' => 'form-control', 'placeholder' => 'Location' ]) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							<div class="col-sm-9 col-sm-offset-3">
								{!! Form::input('checkbox', 'all_day', 1, ['id' => 'all_day']) !!}
								{!! Form::label('all_day', 'All Day', ['class' => 'control-label']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_start_date', 'Start Date: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_start_date', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'form-control input-date']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_start_time', 'Start Time: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_start_time', \Carbon\Carbon::parse("00:00")->format('H:i'), ['class' => 'form-control input-time']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_end_date', 'End Date: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_end_date', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'form-control input-date']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_end_time', 'End Time: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_end_time', \Carbon\Carbon::parse("00:00")->format('H:i'), ['class' => 'form-control input-time']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_description', 'Description: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::textarea('event_description', null, ['class' => 'form-control']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_type', 'Event Type: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::select('event_type', $eventTypes, null, ['class' => 'form-control']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
					</div>
				</div>
				{{-- /.panel --}}
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
				{{-- /.panel --}}
			</div>
		{!! Form::close() !!}
	</div>
@endsection
