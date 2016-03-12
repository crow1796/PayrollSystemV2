<div class="modal fade" id="delete-confirmation-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['method' => 'DELETE', 'url' => $url]) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Confirm Delete</h4>
				</div>
				<div class="modal-body">
					<p class="text-center">Are you sure you want to delete this?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Delete <span class="fa fa-check-circle"></span></button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>