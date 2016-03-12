@extends('layouts.app', ['title' => 'Edit Event/Holiday'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 4])
@endsection

@section('content')
	@include('errors.partials._requesterrors')
    <h2 class="page-header">Edit Holiday/Event</h2>
	<div class="row">
		{!! Form::model($event, ['method' => 'PUT', 'url' => url('/calendar', $event->id)]) !!}
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
								{!! Form::text('event_name', $event->title, ['class' => 'form-control', 'placeholder' => 'Event or Holiday Name', 'required']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_location', 'Event Location: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_location', $event->location, ['class' => 'form-control', 'placeholder' => 'Location' ]) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							<div class="col-sm-9 col-sm-offset-3">
								{!! Form::input('checkbox', 'all_day', 1, ['checked' => $event->allDay]) !!}
								{!! Form::label('all_day', 'All Day', ['class' => 'control-label']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_start_date', 'Start Date: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_start_date', $event->start->format('m/d/Y'), ['class' => 'form-control input-date']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_start_time', 'Start Time: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_start_time', $event->start->format('H:i'), ['class' => 'form-control input-time']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_end_date', 'End Date: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_end_date', $event->start->format('m/d/Y'), ['class' => 'form-control input-date']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_end_time', 'End Time: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('event_end_time', $event->start->format('H:i'), ['class' => 'form-control input-time']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_description', 'Description: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::textarea('event_description', $event->description, ['class' => 'form-control']) !!}
							</div>
						</div>
						{{-- /.Form Group --}}
						<div class="form-group row">
							{!! Form::label('event_type', 'Event Type: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::select('event_type', $eventTypes, $event->eventType->id, ['class' => 'form-control']) !!}
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
