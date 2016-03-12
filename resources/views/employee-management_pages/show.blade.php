@extends('layouts.app', ['title' => $employee->id])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 0])
@endsection

@section('content')
	<h2 class="page-header">
	    {{ $employee->fullname }} <small>{{ $employee->id }}</small>
	    <a href="{{ url('employees', $employee->id) }}/edit" class="btn btn-xs btn-primary">
	        <span class="fa fa-edit"></span> Edit
	    </a>
	    <a data-toggle="modal" href="#delete-confirmation-modal" class="btn btn-xs btn-danger">
	        <span class="fa fa-trash"></span> Delete
	    </a>
	</h2>

	<div class="row">
		<div class="col-sm-4">
			
		</div>
		<div class="col-sm-8">
			
		</div>
	</div>

	@include('partials._confirm_delete_modal', ['url' => url('employees', $employee->id)])

@endsection