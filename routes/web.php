<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TempController;
use App\Http\Controllers\PendingController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\controllers\StatusController;
use App\Http\controllers\MailController;
use App\Http\Middleware\EmpMiddleware;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Auth\Request;
use App\Http\Controllers\Auth\Request\LoginRequest;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return view('welcome');
});
// Login Page
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login2', [LoginController::class, 'login'])->name('login2');
// registration page
Route::get('/register', [LoginController::class, 'register_view'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [LoginController::class, 'dashboard']);

Route::resource('emp',TempController::class);
Route::resource('task',TaskController::class);

Route::get('/pending', [PendingController::class, 'index']);
Route::get('/complete', [PendingController::class, 'complete']);
Route::get('/taskcompleted/{id}', [PendingController::class, 'taskcompleted']);

Route::get('sendbasicemail',[MailController::class,'basic_email']);
Route::get('sendhtmlemail',[MailController::class,'html_email']);
Route::get('sendattachmentemail',[MailController::class,'attachment_email']);

Route::get('/report', [ReportController::class, 'index']);
route::post('/report2',[ReportController::class,'report']);

Route::get('/status',[StatusController::class, 'index']);
Route::post('/status2',[StatusController::class, 'stat']);


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


