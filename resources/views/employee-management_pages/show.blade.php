@extends('layouts.app', ['title' => $employee->id])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 0])
@endsection

@section('content')
	<a href="{{ \URL::previous() }}" class="btn btn-link btn-xs">&laquo; Back</a>
	<div class="row employee-information-header-container">
		<div class="col-sm-offset-3 col-sm-9">
			<h2>
				{{ $employee->fullname }}
			</h2>
			<span>
				{{ $employee->position->name }}
				<div class="btn-group">
					<button type="button" class="btn btn-xs btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="fa fa-cogs"></span>
					</button>
					<ul class="dropdown-menu">
						<li class="dropdown-header">Options</li>
						<li role="presentation">
							<a href="{{ url('employees', $employee->id) }}/edit">
							    <span class="fa fa-edit"></span> Edit
							</a>
						</li>
						<li role="presentation">
							<a href="{{ url('employees', $employee->id) }}/edit/rates">
							    <span class="fa fa-dollar"></span> Edit Rates
							</a>
						</li>
						<li role="presentation">
							<a href="{{ url('employees', $employee->id) }}/edit/deductions">
							    <span class="fa fa-dollar"></span> Edit Deductions
							</a>
						</li>
						<li role="presentation">
							<a data-toggle="modal" href="#delete-confirmation-modal">
							    <span class="fa fa-trash"></span> Delete
							</a>
						</li>
					</ul>
				</div>
			</span>
		</div>
	</div>
	
	<div class="row employee-information-content-container">
		<div class="col-sm-3">
			<div class="employee-display-photo-container">
				<img src="{{ !$employee->additionalInformation->display_photo ? url('images/default_user_thumbnail.png') : url($employee->additionalInformation->display_photo) }}" alt="" class="center-block img-thumbnail img-responsive">
			</div>
			
			<div class="employee-information-important-container">
				<ul class="bmpc-list">
					<li class="bmpc-list-item">
						<span class="bmpc-list-item-title"><span class="fa fa-user"></span> Employee ID</span>
						<span class="bmpc-list-item-content">{{ $employee->id }} <span class="fa fa-circle {{ $employee->active ? 'text-success' : 'text-danger' }}" title="{{ $employee->active ? 'Active' : 'Inactive' }}"></span></span>
						<span class="bmpc-list-item-content">{{ $employee->designation->name }}</span>
						<span class="bmpc-list-item-content">{{ $employee->department->name }}</span>
						<span class="bmpc-list-item-content">{{ $employee->businessUnit->name }}</span>
					</li>
					<li class="bmpc-list-item">
						<span class="bmpc-list-item-title"><span class="fa fa-calendar"></span> Date Employed</span>
						<span class="bmpc-list-item-content">
							{{ $employee->date_employed->format('M d, Y') }}
						</span>
						<span class="bmpc-list-item-content">
							<small>{{ $employee->date_employed->diffForHumans() }}
						</small></span>
					</li>
					<li class="bmpc-list-item">
						<span class="bmpc-list-item-title"><span class="fa fa-heart"></span> Status</span>
						<span class="bmpc-list-item-content">
							{{ ($employee->active) ? 'Active' : 'Inactive' }}
						</span>
					</li>
					<li class="bmpc-list-item">
						<span class="bmpc-list-item-title"><span class="fa fa-link"></span> Contact Information</span>
						<span class="bmpc-list-item-content">
							<span class="fa fa-mobile"></span> {{ $employee->contactInformation->mobile_number }}
						</span>
						<span class="bmpc-list-item-content">
							<span class="fa fa-phone"></span> {{ $employee->contactInformation->telephone_number }}
						</span>
						<span class="bmpc-list-item-content">
							{{ $employee->email }}
						</span>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-sm-9 employee-information-content">
			<ul class="nav nav-pills">
				<li role="presentation" class="active">
					<a href="#personal" data-toggle="tab">
						<span class="pill-highlighter"></span>
						Personal
					</a>
				</li>
				<li role="presentation">
					<a href="#benefits" data-toggle="tab">
						<span class="pill-highlighter"></span>
						Benefits
					</a>
				</li>
				<li role="presentation">
					<a href="#contact-information" data-toggle="tab">
						<span class="pill-highlighter"></span>
						Contact Information
					</a>
				</li>
				<li role="presentation">
					<a href="#rates" data-toggle="tab">
						<span class="pill-highlighter"></span>
						Rates
					</a>
				</li>
				<li role="presentation">
					<a href="#deductions" data-toggle="tab">
						<span class="pill-highlighter"></span>
						Deductions
					</a>
				</li>
			</ul>
			{{-- /.nav-pills --}}
			<div class="tab-content">
				@include('employee-management_pages.partials._personal_tab')
				@include('employee-management_pages.partials._benefits_tab')
				@include('employee-management_pages.partials._contact-information_tab')
				@include('employee-management_pages.partials._rates_tab')
				@include('employee-management_pages.partials._deductions_tab')
			</div>
			{{-- /.tab-content --}}
		</div>
	</div>

	@include('partials._confirm_delete_modal', ['url' => url('employees', $employee->id)])

@endsection