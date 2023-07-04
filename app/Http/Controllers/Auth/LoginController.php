<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    
    

    public function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
       
        $request->validate([
            'empemail' => 'required',
            'password' => 'required|min:6',
        ]);
        
   
        $credentials = $request->only('empemail', 'password');
        
        if (Auth::attempt($credentials)) 
        {
           
            return redirect()->back('/dashboard')->with('message','Login Successfully');
                                    
        }
        return redirect()->back('/login')->with('error','Invalid Email or Password');
    }
    public function register_view()
    {
        //echo "hello";
        return view('auth.registration');
    }
    public function register(Request $request)
    {
        
        $request->validate([
            'empname' => 'required',
            'empemail' => 'required|unique:employee_detail,empemail',
            'emprole'=>'required',
            'password' => 'required|min:6',
            'cpassword'=>'required|same:password',
        ]);
           
        employee::create([
            'empname' => $request['empname'],
            'empemail' => $request['empemail'],
            'emprole' => $request['emprole'],
            'password' => Hash::make($request['password']),
            'cpassword' =>$request['cpassword'],
        ]);
       // $data = $request->all();
        //$check = $this->create($data);
         
        if (Auth::attempt($request->only('empemail', 'password'))) 
        {
           return redirect('dashboard')->with('message','Login Successfully');
        }
        return redirect('/login')->with('error','Invalid Email or Password');
    }
    
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('dashboard');
               
        }
       return redirect('/login')->with('You are not allowed to access');
    }
    public function logout(Request $request)
    {
        Session::flush();
       Auth::logout();
       return redirect('/login');
     }
    
    
  
}