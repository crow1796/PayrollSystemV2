@extends('layouts.app', ['title' => 'Employee Management'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 2.1])
@endsection

@section('content')
    @include('errors.partials._requesterrors')
    <h2 class="page-header">
        All Employees
        <a href="{{ url('/employees/create') }}" class="btn btn-xs btn-danger">
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
                                First Name
                            </th>
                            <th class="min-tablet-l">
                                Middle Name
                            </th>
                            <th>
                                Last Name
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
                        @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <span class="id-container">{{ $employee->id }}</span>
                                    <div class="bmpc-table-row-buttons-container">
                                        <ul>
                                            <li>
                                                <a href="{{ url('employees/' . $employee->id) }}">
                                                    <span class="fa fa-user"></span> View
                                                </a>
                                            </li> |
                                            <li>
                                                <a href="{{ url('employees/' . $employee->id) }}/edit">
                                                    <span class="fa fa-edit"></span> Edit
                                                </a>
                                            </li> |
                                            <li>
                                                <a type="submit" data-toggle="modal" class="btn-link btn-md delete-employee-confirmation-modal-button" href="#delete-confirmation-modal">
                                                    <span class="fa fa-trash"></span> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    {{ $employee->first_name }}
                                </td>
                                <td>
                                    {{ $employee->middle_name }}
                                </td>
                                <td>
                                    {{ $employee->last_name }}
                                </td>
                                <td>
                                    {{ $employee->department->name }}
                                </td>
                                <td>
                                    {{ $employee->position->name }}
                                </td>
                                <td>
                                    {{ $employee->additionalInformation->gender }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials._confirm_delete_modal', ['url' => '#'])
@endsection
