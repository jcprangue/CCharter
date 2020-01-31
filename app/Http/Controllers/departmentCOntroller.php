<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\departments;
use DB;


class departmentCOntroller extends Controller
{
    public function findAllDepartments(){
        
        return departments::orderBy('department','ASC')->get();
    }
}
