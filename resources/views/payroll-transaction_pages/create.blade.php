@extends('layouts.app', ['title' => 'Create Transaction'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 3.2])
@endsection

@section('content')
	<h2 class="page-header">
	    Create Transaction
	</h2>

	<div class="row">
		{!! Form::open(['method' => 'POST', 'url' => url('payroll/create/confirm')]) !!}
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						Set Cut-offs
					</div>
					<div class="panel-body panel-body-active">
						<div class="form-group row">
							<label for="first_cutoff" class="control-label col-sm-2 col-sm-offset-3">
								<input type="radio" name="cutoff" id="first_cutoff" value="First" checked>
								First
							</label>
							<label for="second_cutoff" class="control-label col-sm-2">
								<input type="radio" name="cutoff" id="second_cutoff" value="Second">
								Second
							</label>
						</div>
						{{-- /.form-group --}}
						<div class="form-group row">
							{!! Form::label('cutoff_start', 'Cut-off Start: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('cutoff_start', \Carbon\Carbon::now()->format('m/d/Y'), ['class' => 'form-control input-date', 'placeholder' => 'Cut-off Start']) !!}
							</div>
						</div>
						{{-- /.form-group --}}
						<div class="form-group row">
							{!! Form::label('cutoff_end', 'Cut-off End: ', ['class' => 'control-label col-sm-3']) !!}
							<div class="col-sm-9">
								{!! Form::text('cutoff_end', \Carbon\Carbon::now()->addDay(14)->format('m/d/Y'), ['class' => 'form-control input-date', 'placeholder' => 'Cut-off End (Auto added 15days)']) !!}
							</div>
						</div>
						{{-- /.form-group --}}
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						Manage Fields
					</div>
					<div class="panel-body panel-body-active">
						{!! Form::submit('Save', ['class' => 'btn btn-block btn-primary btn-md']) !!}
						{!! Form::reset('Reset', ['class' => 'btn btn-block btn-danger btn-md']) !!}
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@endsection