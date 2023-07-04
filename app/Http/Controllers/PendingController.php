<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\task;
class PendingController extends Controller
{

 
    public function index()
    {
        $myname = session('empname');
        $mytype = session('usertype');
        $myid = session('id');

        $abc = DB::table('task')
        ->select('*')
        ->where('assignto', $myid)
        ->where('status', 'pending')
        ->get();
        //dd($abc);
        //return;
        $users = DB::table('task')->get();
        $data=compact('users','myid','abc','myname','mytype');
        return view('pending')->with($data);
        $users = DB::table('task')->get();
        return view('pending', ['users' => $users]);
        
    }
    public function complete()
    {
        $myname = session('empname');
        $mytype = session('usertype');
        $myid = session('id');
        
        $abc = DB::table('task')
        ->select('*')
        ->where('assignto', $myid)
        ->where('status', 'completed')
        ->get();
        //echo  "<pre>";
        //print_r($abc);
        //return;
     
        $users = DB::table('task')->get();
        $data=compact('users','myid','abc','myname','mytype');
        return view('complete')->with($data);
    }
    public function taskcompleted($id)
    { // echo "hello";
       // return;
        
        $user= task::find($id);  
        $user->status='completed';
        $user->save();

       return redirect('/complete');
                
    }
}
