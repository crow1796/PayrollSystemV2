@extends('layouts.app', ['title' => 'Logs'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 7.3])
@endsection

@section('content')
    @include('errors.partials._requesterrors')
    <h2 class="page-header">
        Logs
    </h2>

    <div class="row">
        <div class="col-sm-12">
            <div class="bmpc-table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="all">
                                ID
                            </th>
                            <th class="min-tablet-p">
                                Username
                            </th>
                            <th class="min-tablet-p">
                                Full Name
                            </th>
                            <th class="min-tablet-l">
                                Permission
                            </th>
                            <th class="min-tablet-l">
                                Department
                            </th>
                            <th class="min-tablet-l">
                                Position
                            </th>
                            <th class="min-tablet-p">
                                Last Login
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($logs as $log)
                    		<tr>
                    			<td>
                                    <span class="id-container">{{ $log->id }}</span>
                                    <div class="bmpc-table-row-buttons-container">
                                        <ul>
                                            <li>
                                                <a type="submit" data-toggle="modal" class="btn-link btn-md delete-log-confirmation-modal-button" href="#delete-confirmation-modal">
                                                    <span class="fa fa-trash"></span> Delete Log
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $log->user->username }}</td>
                                <td>{{ $log->user->fullname }}</td>
                                <td>{{ $log->user->permission->name }}</td>
                                <td>{{ $log->user->employmentInformation->department->name }}</td>
                                <td>{{ $log->user->employmentInformation->position->name }}</td>
                                <td>{{ $log->last_login->diffForHumans() }} <small>{{ $log->last_login->format('M m,Y') }} at {{ $log->last_login->format('h:i:sA') }}</small></td>
                    		</tr>
                    	@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials._confirm_delete_modal', ['url' => '#'])
@endsection
