<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Repositories\Eloquent\DailyRecordRepository;
use App\Repositories\Eloquent\PayrollTransactionRepository;
use App\Http\Requests\EmployeeTransactionRequest;
use App\Support\Excel\EmployeeDTRListImport;
use App\Support\File\FileManager;
use Validator;
use App\Support\Payroll\PayrollTransaction;

class PayrollTransactionController extends Controller
{

    protected $employeeRepository;
    protected $payrollTransactionRepository;
    protected $dtrRepository;
    protected $payroll;

    public function __construct(EmployeeRepository $employeeRepository, 
                                DailyRecordRepository $dtrRepository,
                                PayrollTransaction $payroll,
                                PayrollTransactionRepository $payrollTransactionRepository){
        $this->middleware('manager', ['except' => ['index', 'show']]);
        $this->employeeRepository = $employeeRepository;
        $this->dtrRepository = $dtrRepository;
        $this->payroll = $payroll;
        $this->payrollTransactionRepository = $payrollTransactionRepository;
    }

    public function index(){
        $transactions = $this->payrollTransactionRepository->all();
        return view('payroll-transaction_pages.index', compact(['transactions']));
    }

    public function create(){
        return view('payroll-transaction_pages.create');
    }

    public function show(\App\PayrollTransaction $transaction){
        $salaryStack = $this->payroll->transact($transaction->toArray());
        return view('payroll-transaction_pages.show', compact(['transaction', 'salaryStack']));
    }

    public function createManual(){
        $employees = $this->employeeRepository->all();
        return view('payroll-transaction_pages.manual_dtr', compact(['employees']));
    }

    public function createImport(){
        return view('payroll-transaction_pages.import_dtr');
    }

    public function store(Request $request){
        $transactionData = $request->all();
        unset($transactionData['_token']);

        $salaryStack = $this->payroll->transact($transactionData);
        $created = $this->payrollTransactionRepository->create($transactionData);
        return $created ? redirect('payroll') : redirect()->back()->withMessage('Cannot create transaction.');
    }

    public function edit(\App\PayrollTransaction $transaction){
        return view('payroll-transaction_pages.edit', compact(['transaction']));
    }

    public function update(Request $request, \App\PayrollTransaction $transaction){
        $transactionData = $request->all();
        unset($transactionData['_token']);
        unset($transactionData['_method']);

        $updated = $this->payrollTransactionRepository->updateByModel($transactionData, $transaction);
        return $updated ? redirect('payroll/' . $transaction->id) : redirect()->back()->withMessage('Cannot update transaction.');
    }

    public function destroy(\App\PayrollTransaction $transaction){
    	if(!$this->payrollTransactionRepository
                ->deleteByModel($transaction)){
            return redirect('/payroll')->withMessage('Unable to delete transaction.');
        }
        return redirect('/payroll');
    }

    public function storeImport(Request $request, FileManager $fileManager){
        $files = $request->files->all()['excel_csv'];

        if($fileManager->uploadFilesToDisk($files, 'imports')){
            return redirect('/payroll')->withMessage('File has been uploaded successfully.');
        }
        
        return redirect('/payroll/dtr/import')->withMessage('Uploading file failed. Please try again.');
    }

    public function storeManual(Request $request){
        $this->ajaxCheck($request);
        
        $validation = $this->manualDTRValidation($request->all());

        if($validation->fails()){
            return $validation->errors()->toArray() + ['errors' => true];
        }

        if(!$this->dtrRepository->create($request->all())){
            return  ['error' => ['Saving Error!'], 'errors' => true];
        }

        return 'Saved!';
    }

    private function manualDTRValidation($data){
        $validationRules = [
            'employee_id' => 'required|exists:employees,id',
            'time_in' => 'required|numeric|min:0|max:2400',
            'time_out' => 'required|numeric|min:0|max:2400',
            'record_date' => 'required|before:' . \Carbon\Carbon::now()->addDay(1)->format('m/d/Y'),
        ];
        $validation = Validator::make($data, $validationRules);

        return $validation;
    }

    public function employeePayslip(Request $request){
        $this->ajaxCheck($request);
        $salaryStack = $this->payroll->transact($request->all());

        foreach($salaryStack->all() as $salary){
            if($salary->employee()->id === $request->employeeId){
                $minimumWage = $salary->employee()->rates->count() > 0 ? ($salary->employee()->rates[0]->regular * 8) : ($salary->employee()->department->rates[0]->regular * 8);
                $payslipInformation = [
                    'fullname' => $salary->employee()->fullname,
                    'service_location' => $salary->employee()->businessUnit->name,
                    'project' => $salary->employee()->department->name,
                    'days' => [
                        'regular' => $salary->workDays()['regular'],
                        'sun' =>  $salary->workDays()['sun'],
                        'spl_holiday' =>  $salary->workDays()['spl_holiday'],
                        'legal_holiday' =>  $salary->workDays()['legal_holiday'],
                        'legal_sun' =>  $salary->workDays()['legal_sun'],
                        'no_work_legal_holiday' =>  $salary->workDays()['no_work_legal_holiday'],
                    ],
                    'hours' => [
                        'regular' => $salary->workHours()['regular'],
                        'regular_ot' => $salary->workHours()['regular_ot'],
                        'regular_nd' => $salary->workHours()['regular_nd'],
                        'regular_nd_ot' => $salary->workHours()['regular_nd_ot'],
                        'sun' => $salary->workHours()['sun'],
                        'sun_ot' => $salary->workHours()['sun_ot'],
                        'sun_nd' => $salary->workHours()['sun_nd'],
                        'sun_nd_ot' => $salary->workHours()['sun_nd_ot'],
                        'spl_holiday' => $salary->workHours()['spl_holiday'],
                        'spl_holiday_ot' => $salary->workHours()['spl_holiday_ot'],
                        'spl_holiday_nd' => $salary->workHours()['spl_holiday_nd'],
                        'spl_holiday_nd_ot' => $salary->workHours()['spl_holiday_nd_ot'],
                        'legal_holiday' => $salary->workHours()['legal_holiday'],
                        'legal_holiday_ot' => $salary->workHours()['legal_holiday_ot'],
                        'legal_holiday_nd' => $salary->workHours()['legal_holiday_nd'],
                        'legal_holiday_nd_ot' => $salary->workHours()['legal_holiday_nd_ot'],
                        'legal_sun' => $salary->workHours()['legal_sun'],
                        'legal_sun_ot' => $salary->workHours()['legal_sun_ot'],
                        'legal_sun_nd' => $salary->workHours()['legal_sun_nd'],
                        'legal_sun_nd_ot' => $salary->workHours()['legal_sun_nd_ot'],
                    ],
                    'incomes' => [
                        'regular' => $salary->workIncomes()['regular'],
                        'regular_ot' => $salary->workIncomes()['regular_ot'],
                        'regular_nd' => $salary->workIncomes()['regular_nd'],
                        'regular_nd_ot' => $salary->workIncomes()['regular_nd_ot'],
                        'sun' => $salary->workIncomes()['sun'],
                        'sun_ot' => $salary->workIncomes()['sun_ot'],
                        'sun_nd' => $salary->workIncomes()['sun_nd'],
                        'sun_nd_ot' => $salary->workIncomes()['sun_nd_ot'],
                        'spl_holiday' => $salary->workIncomes()['spl_holiday'],
                        'spl_holiday_ot' => $salary->workIncomes()['spl_holiday_ot'],
                        'spl_holiday_nd' => $salary->workIncomes()['spl_holiday_nd'],
                        'spl_holiday_nd_ot' => $salary->workIncomes()['spl_holiday_nd_ot'],
                        'legal_holiday' => $salary->workIncomes()['legal_holiday'],
                        'legal_holiday_ot' => $salary->workIncomes()['legal_holiday_ot'],
                        'legal_holiday_nd' => $salary->workIncomes()['legal_holiday_nd'],
                        'legal_holiday_nd_ot' => $salary->workIncomes()['legal_holiday_nd_ot'],
                        'legal_sun' => $salary->workIncomes()['legal_sun'],
                        'legal_sun_ot' => $salary->workIncomes()['legal_sun_ot'],
                        'legal_sun_nd' => $salary->workIncomes()['legal_sun_nd'],
                        'legal_sun_nd_ot' => $salary->workIncomes()['legal_sun_nd_ot'],
                        'no_work_legal_holiday' => $salary->workIncomes()['no_work_legal_holiday'],
                    ],
                    'investments' => [
                        'investment_1' => $salary->deductions()['investments']['investment_1'],
                        'investment_2' => $salary->deductions()['investments']['investment_2'],
                        'investment_3' => $salary->deductions()['investments']['investment_3'],
                        'investment_4' => $salary->deductions()['investments']['investment_4'],
                        'investment_5' => $salary->deductions()['investments']['investment_5'],
                        'investment_6' => $salary->deductions()['investments']['investment_6'],
                        'investment_7' => $salary->deductions()['investments']['investment_7'],
                        'total' => $salary->totalInvestments(),
                    ],
                    'expenses' => [
                        'coop_share_capital' => $salary->deductions()['expenses']['coop_share_capital'],
                        'contributions' => [
                            'sss' => $salary->deductions()['expenses']['contributions']['sss'],
                            'pagibig' => $salary->deductions()['expenses']['contributions']['pagibig'],
                            'philhealth' => $salary->deductions()['expenses']['contributions']['philhealth'],
                        ],
                        'loans' => [
                            'sss' => $salary->deductions()['expenses']['loans']['sss'],
                            'pagibig' => $salary->deductions()['expenses']['loans']['pagibig'],
                            'emergency' => $salary->deductions()['expenses']['loans']['emergency'],
                        ],
                        'total' => $salary->totalExpenses(),
                    ],
                    'gross_pay' => $salary->grossPay(),
                    'net_pay' => $salary->netPay(),
                    'minimum_wage' => $minimumWage,
                ];
                return json_encode($payslipInformation);
            }
        }

        return false;
    }
}
