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
}
