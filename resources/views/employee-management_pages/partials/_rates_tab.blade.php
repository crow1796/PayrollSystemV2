<div id="rates" class="tab-pane slide">
	<h4 class="page-header">Rates</h4>
	@for($i = 0; $i < count($rateNames) - 1; $i+=2)
		<div class="information-group-container">
			<div class="information-group">
				<div class="information-group-fields row">
					<div class="col-sm-4">
						<span class="information-label">
							{{ $rateNames[$i] }}
						</span>
						<div class="information-field">
							{{ $employeeRates->{$rateKeys[$i]} }}
						</div>
					</div>
					{{-- Col --}}
					<div class="col-sm-4">
						<span class="information-label">
							{{ $rateNames[$i + 1] }}
						</span>
						<div class="information-field">
							{{ $employeeRates->{$rateKeys[$i + 1]} }}
						</div>
					</div>
					{{-- Col --}}
				</div>
				{{-- /.information-group-fields --}}
			</div>
			{{-- /.information-group --}}
		</div>
		{{-- /.information-group-container --}}
	@endfor
</div>
{{-- /.tab-pane --}}