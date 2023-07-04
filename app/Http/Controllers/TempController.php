<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Models\employee;


class TempController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
       // $users=employee::all();
        //$data = compact('user'); 
        $myname = session('empname');
        $mytype = session('usertype');
        $users = DB::table('employee_detail')
        ->where('employee_detail.usertype','!=','admin')
        ->get();
        //dd($users);
        $data = compact('myname','users','mytype');
        return view('employee')->with($data);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $myname = session('empname');
        $mytype = session('usertype');
        $data = compact('myname','mytype');
        return view('employeeadd')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData= $request->validate(
            [
                'empname'=>'required',
                'empemail'=>'required|email',
                'emprole'=>'required',
                'password'=>'required|min:6',
                'cpassword'=>'required|min:6'
            ]
            
            );
        $empname = $request->input('empname');
        $empemail = $request->input('empemail');
        $emprole = $request->input('emprole');
        $password = $request->input('password');
        $cpassword = $request->input('cpassword');
        $data=array('empname'=>$empname,"empemail"=>$empemail,"emprole"=>$emprole,"usertype"=>'employee',"password"=>$password,"cpassword"=>$cpassword);
        DB::table('employee_detail')->insert($data);
        return redirect('/emp')->with('message','Data added Successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $myname = session('empname');
        $mytype = session('usertype');
          $user= employee::find($id); 
          $data = compact('user','myname','mytype'); 
            return view('employeeedit')->with($data);

        
       // $users = DB::select('select * from student_details');
        //return view('employeeedit',['users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
       // echo "hello";
       // return;
        
        $user= employee::find($id);  
        $user->empname=$request['empname'];
        $user->empemail=$request['empemail'];
        $user->emprole=$request['emprole'];
        $user->save();

       return redirect('/emp');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //echo "hello";
       // return;
        employee::find($id)->delete();
        //$user=employee::find($id);
        //$user->delete();
        return redirect('/emp');
    }
}