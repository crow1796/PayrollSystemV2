@extends('layouts.app', ['title' => 'Payroll Transactions'])

@section('sidebar_nav')
    @include('partials._sidebar_nav', ['active' => 3.1])
@endsection

@section('content')
    <a href="{{ url('payroll') }}" class="btn btn-link btn-xs">&laquo; Back</a>
    <h2 class="page-header">
        Payroll Transaction
        {{-- <a href="{{ url('payroll/create') }}" class="">
            New Transaction
        </a> --}}
        <a type="submit" data-toggle="modal" class="btn btn-xs btn-danger delete-transaction-confirmation-modal-button" href="#delete-confirmation-modal">
            <span class="fa fa-trash"></span> Delete Transaction
        </a>
    </h2>
    
    <div class="row">
        <div class="col-sm-8">
            <p id="period">
                <b>Period:</b> 
                <b><span id="period-start">{{ $transaction->cutoff_start->format('F d, Y') }}</span></b>
                 - 
                <b><span id="period-end">{{ $transaction->cutoff_end->format('F d, Y') }}</span></b>
                 - 
                <span>
                    <b><span id="cutoff">{{ $transaction->cutoff }}</span> Cut-off</b>
                </span>
            </p>

            <div class="bmpc-table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Full Name
                            </th>
                            <th>
                                Gross Pay
                            </th>
                            <th>
                                Net Pay
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salaryStack->all() as $salary)
                            <tr>
                                <td>
                                    <a class="display-employee-payslip-button" href="#" data-employee_id="{{ $salary->employee()->id }}">
                                        {{ $salary->employee()->id }} &raquo;
                                    </a>
                                </td>
                                <td>{{ $salary->employee()->fullname }}</td>
                                <td>&#8369; {{ $salary->grossPay() }}</td>
                                <td>&#8369; {{ $salary->netPay() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- /.col-8 --}}
        <div class="col-sm-4">
            <div class="panel panel-default employee-payslip-container">
                <div class="panel-heading">
                    Payslip
                </div>
                <div class="panel-body panel-body-active employee-payslip">
                    <div class="pre-payslip">
                        <p>Members Name: <span id="members-name"> </span></p>
                        <p>Service Location: <span id="service-location"> </span></p>
                        <p>Project: <span id="project"> </span></p>
                        <p>Minimum Wage: <span id="minimum-wage">0.00</span> DAILY</p>
                        <p class="text-center"><b>INCOME</b></p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>DAY/HRS</th>
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Regular --}}
                                <tr>
                                    <td><b>Regular Workdays</b></td>
                                    <td><span id="regular-workdays">0.0</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Regular Hrs</td>
                                    <td><span id="regular-hours">0.0</span></td>
                                    <td><span id="regular-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>OT Hrs</td>
                                    <td><span id="ot-hours">0.0</span></td>
                                    <td><span id="ot-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>ND Hrs</td>
                                    <td><span id="nd-hours">0.0</span></td>
                                    <td><span id="nd-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>NDOT Hrs</td>
                                    <td><span id="nd-ot-hours">0.0</span></td>
                                    <td><span id="nd-ot-pay">0.00</span></td>
                                </tr>
                                {{-- Regular --}}
                                {{-- Sunday --}}
                                <tr>
                                    <td><b>Sunday Workdays</b></td>
                                    <td><span id="sun-workdays">0.0</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Sunday Hrs</td>
                                    <td><span id="sun-hours">0.0</span></td>
                                    <td><span id="sun-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Sunday OT Hrs</td>
                                    <td><span id="sun-ot-hours">0.0</span></td>
                                    <td><span id="sun-ot-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Sunday ND Hrs</td>
                                    <td><span id="sun-nd-hours">0.0</span></td>
                                    <td><span id="sun-nd-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Sunday NDOT Hrs</td>
                                    <td><span id="sun-nd-ot-hours">0.0</span></td>
                                    <td><span id="sun-nd-ot-pay">0.00</span></td>
                                </tr>
                                {{-- Sunday --}}
                                {{-- Special Holiday --}}
                                <tr>
                                    <td><b>SPL Holiday Workdays</b></td>
                                    <td><span id="spl-holiday-workdays">0.0</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>SPL Holiday Hrs</td>
                                    <td><span id="spl-holiday-hours">0.0</span></td>
                                    <td><span id="spl-holiday-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>SPL Holiday OT Hrs</td>
                                    <td><span id="spl-holiday-ot-hours">0.0</span></td>
                                    <td><span id="spl-holiday-ot-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>SPL Holiday ND Hrs</td>
                                    <td><span id="spl-holiday-nd-hours">0.0</span></td>
                                    <td><span id="spl-holiday-nd-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>SPL Holiday NDOT Hrs</td>
                                    <td><span id="spl-holiday-nd-ot-hours">0.0</span></td>
                                    <td><span id="spl-holiday-nd-ot-pay">0.00</span></td>
                                </tr>
                                {{-- Special Holiday --}}
                                {{-- Legal Holiday --}}
                                <tr>
                                    <td><b>Legal Holiday Workdays</b></td>
                                    <td><span id="legal-holiday-workdays">0.0</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday Hrs</td>
                                    <td><span id="legal-holiday-hours">0.0</span></td>
                                    <td><span id="legal-holiday-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday OT Hrs</td>
                                    <td><span id="legal-holiday-ot-hours">0.0</span></td>
                                    <td><span id="legal-holiday-ot-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday ND Hrs</td>
                                    <td><span id="legal-holiday-nd-hours">0.0</span></td>
                                    <td><span id="legal-holiday-nd-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Legal Holiday NDOT Hrs</td>
                                    <td><span id="legal-holiday-nd-ot-hours">0.0</span></td>
                                    <td><span id="legal-holiday-nd-ot-pay">0.00</span></td>
                                </tr>
                                {{-- Legal Holiday --}}
                                {{-- Legal Holiday Sunday --}}
                                <tr>
                                    <td><b>Legal Sunday Workdays</b></td>
                                    <td><span id="legal-sunday-workdays">0.0</span></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Legal Sunday Hrs</td>
                                    <td><span id="legal-sunday-hours">0.0</span></td>
                                    <td><span id="legal-sunday-pay">0.0</span></td>
                                </tr>
                                <tr>
                                    <td>Legal Sunday OT Hrs</td>
                                    <td><span id="legal-sunday-ot-hours">0.0</span></td>
                                    <td><span id="legal-sunday-ot-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Legal Sunday ND Hrs</td>
                                    <td><span id="legal-sunday-nd-hours">0.0</span></td>
                                    <td><span id="legal-sunday-nd-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td>Legal Sunday NDOT Hrs</td>
                                    <td><span id="legal-sunday-nd-ot-hours">0.0</span></td>
                                    <td><span id="legal-sunday-nd-ot-pay">0.00</span></td>
                                </tr>
                                {{-- Legal Holiday Sunday --}}
                            </tbody>
                        </table>
                        {{-- /.Income --}}
                        <p class="text-center"><b>E-COLA</b></p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>No Work Legal Holiday Pay</td>
                                    <td><span id="no-work-legal">0</span></td>
                                    <td><span id="no-work-legal-pay">0.00</span></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- /.E-COLA --}}
                        <p class="text-center"><b>Investments</b></p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="2">Investment 1(Production Paraphernalia)</td>
                                    <td><span id="investment-1">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Investment 2(House Rent Bills)</td>
                                    <td><span id="investment-2">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Investment 3(Mediocare/HMO)</td>
                                    <td><span id="investment-3">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Investment 4(Vale)</td>
                                    <td><span id="investment-4">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Investment 5(Initial Share Capital)</td>
                                    <td><span id="investment-5">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Investment 6(Membership Fee)</td>
                                    <td><span id="investment-6">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Investment 7(BDO ATM Card)</td>
                                    <td><span id="investment-7">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right"><b>TOTAL INVESTMENTS</b></td>
                                    <td><span id="total-investments">0.0</span></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- /.Investments --}}
                        <p class="text-center"><b>Expenses</b></p>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td colspan="2">Coop Share Capital</td>
                                    <td><span id="expenses-1">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">SSS Contribution</td>
                                    <td><span id="expenses-2">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">PhilHealth</td>
                                    <td><span id="expenses-3">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">PAG-IBIG Contribution</td>
                                    <td><span id="expenses-4">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">SSS Loan</td>
                                    <td><span id="expenses-5">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">PAG-IBIG Loan</td>
                                    <td><span id="expenses-6">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Emergency Loan</td>
                                    <td><span id="expenses-7">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right"><b>TOTAL EXPENSES</b></td>
                                    <td><span id="total-expenses">0.0</span></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- /.Investments --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">TOTALS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-right"><b>GROSS PAY</b></td>
                                    <td>&#8369; <span id="gross-pay">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right"><b>NET PAY</b></td>
                                    <td>&#8369; <span id="net-pay">0.00</span></td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- totals --}}
                    </div>
                    {{-- /.pre-payslip --}}
                    <p class="text-right">
                        <button type="button" class="btn btn-md btn-primary">Print <span class="fa fa-print"></span></button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('partials._confirm_delete_modal', ['url' => url('payroll', $transaction->id)])
@endsection
