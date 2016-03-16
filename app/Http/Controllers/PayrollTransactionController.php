<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Repositories\Eloquent\DailyRecordRepository;
use App\Http\Requests\EmployeeTransactionRequest;
use App\Support\Excel\EmployeeDTRListImport;
use App\Support\File\FileManager;
use Validator;
use App\Support\Payroll\PayrollTransaction;

class PayrollTransactionController extends Controller
{

    protected $employeeRepository;
    protected $dtrRepository;
    protected $payroll;

    public function __construct(EmployeeRepository $employeeRepository, 
                                DailyRecordRepository $dtrRepository,
                                PayrollTransaction $payroll){
        $this->employeeRepository = $employeeRepository;
        $this->dtrRepository = $dtrRepository;
        $this->payroll = $payroll;
    }

    public function index(){
        return view('payroll-transaction_pages.index');
    }

    public function create(){
        return view('payroll-transaction_pages.create');
    }

    public function confirmTransaction(Request $request){
        $salaryStack = $this->payroll->transact($request->all());
        $employees = $salaryStack->employees();
    }

    public function createManual(){
        $employees = $this->employeeRepository->all();
        return view('payroll-transaction_pages.manual_dtr', compact(['employees']));
    }

    public function createImport(){
        return view('payroll-transaction_pages.import_dtr');
    }

    public function store(Request $request){

    }

    public function edit($slug){

    }

    public function update($slug, $data){

    }

    public function destroy($slug){
    	
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
