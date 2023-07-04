<?php 
  
namespace App\Http\Controllers\Auth; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\employee; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
  
class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'empemail' => 'required|email|exists:employee_detail',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'empemail' => $request->empemail, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('empemail.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'empemail' => 'required|email|exists:employee_detail',
              'password' => 'required|string|min:6|confirmed',
              'cpassword' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'empemail' => $request->empemail, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = employee::where('empemail', $request->empemail)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['empemail'=> $request->empemail])->delete();
  
          return redirect('/login')->with('message', 'Your password has been changed!');
      }
}