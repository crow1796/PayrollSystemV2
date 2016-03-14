<div id="personal" class="tab-pane fade in active">
	<h4 class="page-header">Personal Information</h4>
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-3">
					<span class="information-label">
						First Name: 
					</span>
					<div class="information-field">
						{{ $employee->first_name }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-3">
					<span class="information-label">
						Middle Name: 
					</span>
					<div class="information-field">
						{{ $employee->middle_name }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-3">
					<span class="information-label">
						Last Name: 
					</span>
					<div class="information-field">
						{{ $employee->last_name }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-3">
					<span class="information-label">
						Suffix Name: 
					</span>
					<div class="information-field">
						{{ $employee->suffix }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<h4 class="page-header">Address</h4>
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Street
					</span>
					<div class="information-field">
						{{ $employee->street}}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-4">
					<span class="information-label">
						City
					</span>
					<div class="information-field">
						{{ $employee->city }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Province
					</span>
					<div class="information-field">
						{{ $employee->province }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-4">
					<span class="information-label">
						Zipcode
					</span>
					<div class="information-field">
						{{ $employee->zipcode }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<h4 class="page-header">Additional Information</h4>
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Date of Birth: 
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->date_of_birth->format('F d, Y') }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-4">
					<span class="information-label">
						Place of Birth: 
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->place_of_birth }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Weight: 
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->weight }}
					</div>
				</div>
				{{-- Col --}}
				<div class="col-sm-4">
					<span class="information-label">
						Height: 
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->height }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
			<div class="information-group-fields row">
				<div class="col-sm-8">
					<span class="information-label">
						Religion: 
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->religion }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Civil Status 
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->civil_status }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-8">
					<span class="information-label">
						Name of Spouse
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->name_of_spouse }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Number of children
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->number_of_children }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-4">
					<span class="information-label">
						Educational Attainment
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->educational_attainment }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-8">
					<span class="information-label">
						Course
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->course }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-8">
					<span class="information-label">
						Father
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->father_name }}
					</div>
				</div>
				{{-- Col --}}
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				<div class="col-sm-8">
					<span class="information-label">
						Mother
					</span>
					<div class="information-field">
						{{ $employee->additionalInformation->mother_name }}
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