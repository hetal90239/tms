<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\task;
use App\Models\employee;

class StatusController extends Controller
{
    public function index()
    {
        $mycode=0;
        $myname = session('empname');
        $mytype = session('usertype');
        $users = DB::table('employee_detail')
        ->where('employee_detail.usertype','!=','admin')
        ->get();
        $data=compact('users','myname','mytype','mycode'); 
        return view('statusreport')->with($data);
       
    }
    public function stat(Request $request)
    {
    $mycode=1;
    $date1 = $request->assigndate;
        $assignto = $request->assignto;
        //$myid = $request->id;
        //print_r($staffid);
        //return;
        $mm1 = substr($date1,0,2);
        $dd1 = substr($date1,3,2);
        $yy1 =	substr($date1,6,4);
  
       $mm2 = substr($date1,13,2);
       $dd2 = substr($date1,16,2);
       $yy2 =	substr($date1,19,4);
        
       //echo $mm1.$dd1.$yy1.$mm2.$dd2.$yy2;
        //return;
  
       $startdate ="$yy1-$mm1-$dd1";
       $enddate="$yy2-$mm2-$dd2";
        // print_r($startdate);
       //print_r($enddate);
       //return;
       //$assignto=session('assignto');
       $abc= DB::table('task as t')
       ->whereBetween('assigndate', array($startdate,$enddate ))
       ->where('t.assignto', $assignto)
       ->where('t.status', 'pending')
       ->leftJoin('employee_detail as ed', 't.assignto', '=', 'ed.id')
        ->select('t.tasktitle','ed.id as employee_id','ed.empname', 't.id','t.assigndate')
       ->get();
        //$assignto = $abc[0]->assignto;
        //echo "<pre>";
        //print_r($user);
        //return;
        $myname = session('empname');
        $mytype = session('usertype');
        $users = DB::table('employee_detail')
        ->where('employee_detail.usertype','!=','admin')
        ->get();
        $data=compact('users','myname','mytype','abc','mycode'); 
        return view('statusreport')->with($data);
    }    
}
