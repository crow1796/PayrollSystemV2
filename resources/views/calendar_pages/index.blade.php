@extends('layouts.app', ['title' => 'Calendar'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 4.1])
@endsection

@section('content')
	@include('errors.partials._requesterrors')
    <h2 class="page-header">
    	Calendar
    	<a title="Add New Event/Holiday" href="{{ url('/calendar/create') }}" class="btn btn-xs btn-danger">
    	    <span class="fa fa-plus-circle"></span> Add New
    	</a>
	</h2>
	
	<div class="row">
		<div class="col-sm-8">
			<div class="events-calendar-container">
				<div class="events-calendar" data-token="{{ csrf_token() }}">
					
				</div>
			</div>
		</div>
		<!-- Calendar -->
		<div class="col-sm-4" id="sidebar-container">
			@if($holidays->count() > 0)
				<section class="sidebar-area">
					<h4 class="sidebar-area-title">Philippines Public Holidays</h4>
					<div class="sidebar-area-list-container">
						<div class="sidebar-area-list-nav-up">
							<span class="fa fa-chevron-up"></span>
						</div>
						<ul id="sidebar-area-public-holidays" class="sidebar-area-list">
							@foreach($holidays as $holiday)
								<li>
									{{ $holiday->title }}
									<small>
										{{ $holiday->start->format('l - F d, Y') }}
									</small>
								</li>
							@endforeach
						</ul>
						<div class="sidebar-area-list-nav-down">
							<span class="fa fa-chevron-down"></span>
						</div>
					</div>
				</section>
			@endif

			@if($upcomingEvents->count() > 0)
				<section class="sidebar-area">
					<h4 class="sidebar-area-title">Upcoming Events/Holidays</h4>
					<div class="sidebar-area-event-wrapper">
						<div class="sidebar-area-event-nav-up">
							<span class="fa fa-chevron-up"></span>
						</div>
						<div class="sidebar-area-event-container">
							@foreach($upcomingEvents as $upcomingEvent)
								<div class="sidebar-area-event">
									<p class="sidebar-area-event-title">{{ $upcomingEvent->title }}</p>
									<p class="sidebar-area-event-start">Start Date: {{ $upcomingEvent->start->format('F d, Y') }}</p>
									<p class="sidebar-area-event-start">
										Start Time: {{ $upcomingEvent->start->format('h:iA') }}
									</p>
									@if($upcomingEvent->end)
										<p class="sidebar-area-event-end">End Date: {{ $upcomingEvent->end->format('F d, Y')  }}</p>
										@if(!$upcomingEvent->allDay)
											<p class="sidebar-area-event-end">End Time: {{ $upcomingEvent->end->format('h:iA')  }}</p>
										@endif
									@endif
									@if($upcomingEvent->allDay)
										<p class="sidebar-area-event-end">All Day</p>
									@endif
									{{-- <p class="sidebar-area-event-location">Location: N/A</p> --}}
								</div>
							@endforeach
							{{-- /.event --}}
						</div>
						<div class="sidebar-area-event-nav-down">
							<span class="fa fa-chevron-down"></span>
						</div>
					</div>
				</section>
			@endif
		</div>
		<!-- /Sidebar -->
	</div>
	@include('partials._confirm_delete_modal', ['url' => '#'])
@endsection
