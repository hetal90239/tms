<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\task;
use App\Models\employee;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::check()){
       $myname = session('empname');
       $mytype = session('usertype');
       //employee::count();

       $users = DB::table('employee_detail')
       ->where([['usertype', '=', 'employee']])
       ->count();

       $users1 = DB::table('task')
       
       ->select([['id']])
       ->count();
       
       //print_r($users1);
       return;
      
        $data = compact('myname','mytype','users','users1');
        return view('dashboard')->with($data);
               
            }
      
            return redirect('/login')->with('You are not allowed to access');
           
        
    }
}
