@extends('layouts.app', ['title' => 'Control Access'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 7.1])
@endsection

@section('content')
    @include('errors.partials._requesterrors')
    <h2 class="page-header">
        All Users
        <a href="{{ url('/control-access/create') }}" class="btn btn-xs btn-danger" title="Add New User">
            <span class="fa fa-plus-circle"></span> Add New
        </a>
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
                            <th class="min-tablet-p">
                                Permission
                            </th>
                            <th class="min-tablet-p">
                                Department
                            </th>
                            <th class="min-tablet-l">
                                Position
                            </th>
                            <th class="min-desktop">
                                Gender
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    	@foreach($users as $user)
                    		<tr>
                    			<td>
                                    <span class="id-container">{{ $user->id }}</span>
                                    <div class="bmpc-table-row-buttons-container">
                                        <ul>
                                            <li>
                                                <a href="{{ url('employees/' . $user->username) }}">
                                                    <span class="fa fa-user"></span> View
                                                </a>
                                            </li> |
                                            <li>
                                                <a href="{{ url('control-access/' . $user->id) }}/edit">
                                                    <span class="fa fa-edit"></span> Edit
                                                </a>
                                            </li> |
                                            <li>
                                                <a type="submit" data-toggle="modal" class="btn-link btn-md delete-user-confirmation-modal-button" href="#delete-confirmation-modal">
                                                    <span class="fa fa-trash"></span> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->fullname }}</td>
                                <td>{{ $user->permission->name }}</td>
                                <td>{{ $user->employmentInformation->department->name }}</td>
                                <td>{{ $user->employmentInformation->position->name }}</td>
                                <td>{{ $user->employmentInformation->additionalInformation->gender }}</td>
                    		</tr>
                    	@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials._confirm_delete_modal', ['url' => '#'])
@endsection
