<div class="modal fade" id="transaction-type-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    Select Transaction Type
                </h4>
            </div>
            <div class="modal-body">
                <a href="{{ url('/payroll/dtr/manual') }}" class="btn btn-lg btn-primary btn-block">Manual</a>
                <a href="{{ url('/payroll/dtr/import') }}" class="btn btn-lg btn-danger btn-block">Import Excel/CSV File</a>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-md" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>