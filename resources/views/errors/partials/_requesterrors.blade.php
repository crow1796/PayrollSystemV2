@if(Session::has('message'))
	<div class="alert alert-danger request-error-container">
        <div class="alert-close-button pull-right">
            <span class="fa fa-close"></span>
        </div>
		{{ Session::get('message') }}
	</div>
@endif
@if($errors->any())
    <div class="alert alert-danger request-error-container">
        <div class="alert-close-button pull-right">
            <span class="fa fa-close"></span>
        </div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif