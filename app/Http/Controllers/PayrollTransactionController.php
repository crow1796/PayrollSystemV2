<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\EmployeeRepository;
use App\Http\Requests\EmployeeTransactionRequest;
use App\Support\Excel\EmployeeDTRListImport;
use App\Support\File\FileManager;

class PayrollTransactionController extends Controller
{

    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository){
        $this->employeeRepository = $employeeRepository;
    }

    public function index(){
        return view('payroll-transaction_pages.index');
    }

    public function create(){
        return view('payroll-transaction_pages.create');
    }

    public function confirmTransaction(Request $request){
        $employees = \App\DailyRecord::where(function($query) use($request){
            $query->where('record_date', '>=', $request->cutoff_start)
                    ->where('record_date', '<=', $request->cutoff_end);
        })->get()->groupBy('employee_id');

        foreach($employees as $employeeDailyTimeRecords){
            foreach($employeeDailyTimeRecords as $dailyTimeRecord){
                echo $dailyTimeRecord->time_in . '<br>';
            }
        }
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
        if(!$request->ajax()){
            return redirect()->back()->withMessage('Unable to fetch data. Please try again.');
        }
        $validationRules = [
            'time_in' => 'required|numeric|min:0|max:2400',
            'time_out' => 'required|numeric|min:0|max:2400'
        ];
        $validation = \Validator::make($request->all(), $validationRules);

        if($validation->fails()){
            return $validation->errors()->toArray() + ['errors' => true];
        }
        
        return 'Saved!';
    }
}
