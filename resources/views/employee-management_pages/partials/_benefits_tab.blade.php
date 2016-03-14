<div id="benefits" class="tab-pane slide">
	<h4 class="page-header">Benefits</h4>
	<div class="information-group-container">
		<div class="information-group">
			<div class="information-group-fields row">
				@foreach($employee->benefits as $benefit)
					<div class="col-sm-3">
						<span class="information-label">
							{{ $benefit->name }}
						</span>
						<div class="information-field">
							{{ $benefit->pivot->benefit_id_value }}
						</div>
					</div>
				@endforeach
			</div>
			{{-- /.information-group-fields --}}
		</div>
		{{-- /.information-group --}}
	</div>
	{{-- /.information-group-container --}}
</div>
{{-- /.tab-pane --}}