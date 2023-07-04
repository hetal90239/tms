<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Controllers\Controller;
use App\Models\task;
use App\Models\employee;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $users=DB::table('task as t')->leftJoin('employee_detail as ed', 't.assignto', '=', 'ed.id')
        ->select('t.tasktitle','ed.id as employee_id','ed.empname', 't.id', 't.status')
        ->get();
        $myname = session('empname');
        $mytype = session('usertype');
        $data=compact('users','myname','mytype');
         //dd($users);
        // return view('task', ['users' => $users]);
        return view('task')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users= employee::all(); 
        $myname = session('empname');
        $mytype = session('usertype');
       $data=compact('users','myname','mytype');
        // return view('taskedit')->with($data);
        return view("taskadd")->with($data);
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $request->validate(
           [
            'tasktitle'=>'required',
           ]);
           
           
        $tasktitle = $request->input('tasktitle');
        $assignto = $request->input('assignto');
           //print_r($assignto);
           //return;
        $currentdate =date('Y-m-d H:i:s');
        $completeddate=date('Y-m-d H:i:s');

        $data=array("tasktitle"=>$tasktitle,"assignto"=>$assignto,"assigndate"=>$currentdate,"completedate"=>$completeddate,"status"=>'pending');
        DB::table('task')->insert($data);
       return redirect('task');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $users = DB::table('employee_detail')
        ->where('employee_detail.usertype','!=','admin')
        ->get();

        $tasks= task::find($id); 

        /*$user=DB::table('task as t')->leftJoin('employee_detail as ed', 't.assignto', '=', 'ed.id')
        ->where('t.id', '=', $id)
        ->select('t.tasktitle','ed.id as employee_id','ed.empname', 't.id', 't.status')
        ->first();
        */


        //dd($tasks->toArray());
        //return;
        $myname = session('empname');
        $mytype = session('usertype');
        $myid = $id;
        $data=compact('tasks','myid','myname','mytype','users');

        // $user=task::find($id); 
        //dd($user);
        return view('taskedit')->with($data);
        // $users = employee::all();
        //$data=compact('user'); 
        //return view('taskedit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          
       //echo "hello";
       //return;
        
       $user= task::find($id);  
       $user->tasktitle=$request['tasktitle'];
       $user->assignto=$request['assignto'];
       $user->save();

      return redirect('/task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        task::find($id)->delete();
        return redirect('/task');
    }
}
