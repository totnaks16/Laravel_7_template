<?php

namespace App\Http\Controllers;

use App\Company;
use App\Department;
use App\Employee;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function get_data(){
        $companies_data = Company::all();
        $departments_data = Department::all();
        $sections_data = Section::all();
        $data = Employee::from('employees as E')
                ->select('E.employee_name', 
                    DB::raw('
                        CASE WHEN E.gender = 1 
                            THEN "Male" 
                            ELSE "Female" 
                        END as gender, 
                        CASE WHEN E.contract_status = "R" 
                            THEN "Regular" 
                            ELSE "Contractual" 
                        END as contract_status'), 
                'C.company_name', 'D.department_name', 'S.section_name')
                ->leftjoin('companies as C', 'C.company_code', '=', 'E.company_code')
                ->leftjoin('departments as D', function($join) {
                    $join->on('D.company_code', '=', 'C.company_code')
                        ->on('D.department_code', '=', 'E.department_code');
                })
                ->leftjoin('sections as S', function($join) {
                    $join->on('S.company_code', '=', 'C.company_code')
                        ->on('S.department_code', '=', 'D.department_code')
                        ->on('S.section_code', '=', 'E.section_code');
                })
                ->orderBy('E.employee_code', 'asc')
                ->get();


        return $data;
    }
 
    // public function insert_data(Request $req){
    //     $company_code = $req->input('company_code');
    //     $department_code = $req->input('department_code');
    //     $section_code = $req->input('section_code');
    //     $gender = $req->input('gender');
    //     $contract_status = $req->input('contract_status');
    //     $employee_name = $req->input('employee_name');

    //     $if_existing = Employee::select('employee_name')
    //                 ->where('company_code', $company_code)
    //                 ->where('department_code', $department_code)
    //                 ->where('section_code',$section_code)
    //                 ->where('employee_name','like', '%'.$employee_name.'%')
    //                 ->get();

    //     if(count($if_existing) == 0 && $employee_name != '' && $department_code != '' && $section_code != ''){
    //         $latest_code = Employee::max('employee_code');

    //         $final_code = str_pad($latest_code > 0 ? $latest_code+1 : '1', 5, '0', STR_PAD_LEFT);

    //         Employee::insert(
    //             [
    //                 'employee_code'=>$final_code, 
    //                 'employee_name'=>$employee_name, 
    //                 'gender'=>$gender, 
    //                 'contract_status'=>$contract_status, 
    //                 'company_code'=>$company_code, 
    //                 'department_code'=>$department_code, 
    //                 'section_code'=>$section_code, 
    //                 'created_at'=>date('Y-m-d H:i:s'), 
    //                 'updated_at'=>date('Y-m-d H:i:s'), 
    //                 'updated_by'=>'36825'
    //             ]
    //         );
    //     }

    //     return $this->get_data();
    // }
}
