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
                                Date
                            </th>
                            <th>
                                By
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
