@extends('layouts.app', ['title' => 'Payroll Transactions'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 3.1])
@endsection

@section('content')

    <h2 class="page-header">
        Payroll Transactions
        <a href="{{ url('payroll/create') }}" class="btn btn-xs btn-danger">
            New Transaction
        </a>
    </h2>

    <div class="row">
        <div class="col-sm-12">
            <div class="bmpc-table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Cut-off Start
                            </th>
                            <th>
                                Cut-off End
                            </th>
                            <th>
                                Cut-off
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    <span class="id-container">{{ $transaction->id }}</span>
                                    <div class="bmpc-table-row-buttons-container">
                                        <ul>
                                            <li>
                                                <a href="{{ url('payroll/' . $transaction->id) }}">
                                                    <span class="fa fa-user"></span> View
                                                </a>
                                            </li> |
                                            <li>
                                                <a href="{{ url('payroll/' . $transaction->id) }}/edit">
                                                    <span class="fa fa-edit"></span> Edit
                                                </a>
                                            </li> |
                                            <li>
                                                <a type="submit" data-toggle="modal" class="btn-link btn-md delete-transaction-confirmation-modal-button" href="#delete-confirmation-modal">
                                                    <span class="fa fa-trash"></span> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>{{ $transaction->cutoff_start->format('F d, Y') }}</td>
                                <td>{{ $transaction->cutoff_end->format('F d, Y') }}</td>
                                <td>{{ $transaction->cutoff }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('partials._confirm_delete_modal', ['url' => '#'])
@endsection
