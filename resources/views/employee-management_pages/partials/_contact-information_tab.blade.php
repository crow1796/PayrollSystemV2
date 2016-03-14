<div id="contact-information" class="tab-pane slide">
	<h4 class="page-header">Contact Information</h4>
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Mobile Number
					</span>
					<div class="information-field">
						{{ $employee->contactInformation->mobile_number }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-4">
					<span class="information-label">
						Telephone Number
					</span>
					<div class="information-field">
						{{ $employee->contactInformation->telephone_number }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<h4 class="page-header text-danger">In case of Emergency</h4>
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Contact Name
					</span>
					<div class="information-field">
						{{ $employee->contactInformation->emergency_name }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-4">
					<span class="information-label">
						Contact Number
					</span>
					<div class="information-field">
						{{ $employee->contactInformation->emergency_number }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
</div>
{{-- /.tab-pane --}}