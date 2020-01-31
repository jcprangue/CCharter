<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Db;
use App\charter;
use App\departments;

use App\Excel\import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class CharterController extends Controller
{
    public function findDeptCharter(Request $r){
        $code = $r->service_code;

        $charts = charter::where('dept',$r->id)
                ->where(function($query) use ($code){
                    if($code != null || $code != ""){
                        $query->where('service_code',$code);
                    }
                }) 
                ->get();    
        return $charts;
    }

    public function findsearch($search){//Capability

        $charts = charter::where('service_name','LIKE','%' . $search .'%')->get();    
        return $charts;
    }

    public function findsearchbydept($id){

        $charts = charter::where('dept',$id)->whereNotNull('service_name')->get();    
        return $charts;
    }

    public function findOffice($id){
        $office = departments::find($id);
        return $office;
    }

     public function findsearchdept(Request $r){//Capability

        $charts = charter::where('dept',$r->id)->where('service_name','LIKE','%' . $r->search .'%')->first();    

        $newchart = charter::where('service_code',$charts->service_code)->get();
        return $newchart;
    }

    public function import() 
    {
        $import = new import();
        $import->onlySheets('PLO', 'PSWDO');

        Excel::import($import, 'citizenscharter.xlsx');

        // Excel::import(new import, 'citizenscharter.xlsx');
        
        // return redirect('/')->with('success', 'All good!');
    }

    
}
