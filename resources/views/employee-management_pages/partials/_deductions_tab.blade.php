<div id="deductions" class="tab-pane slide">
	<h4 class="page-header">Expenses</h4>
	@for($i = 0; $i < count($expenses) - 1; $i+=2)
		<div class="information-group-container">
			<div class="information-group">
				<div class="information-group-fields row">
					<div class="col-sm-4">
						<span class="information-label">
							{{ $expenses[$i]->name }}
						</span>
						<div class="information-field">
							{{ $expenses[$i]->pivot->deduction }}
						</div>
					</div>
					{{-- Col --}}
					<div class="col-sm-4">
						<span class="information-label">
							{{ $expenses[$i + 1]->name }}
						</span>
						<div class="information-field">
							{{ $expenses[$i + 1]->pivot->deduction }}
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

	<h4 class="page-header">Investments</h4>
	@for($i = 0; $i < count($investments) - 1; $i+=2)
		<div class="information-group-container">
			<div class="information-group">
				<div class="information-group-fields row">
					<div class="col-sm-4">
						<span class="information-label">
							{{ $investments[$i]->name }}
						</span>
						<div class="information-field">
							{{ $investments[$i]->pivot->deduction }}
						</div>
					</div>
					{{-- Col --}}
					<div class="col-sm-4">
						<span class="information-label">
							{{ $investments[$i + 1]->name }}
						</span>
						<div class="information-field">
							{{ $investments[$i + 1]->pivot->deduction }}
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