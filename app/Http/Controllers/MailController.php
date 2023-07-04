<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail; 
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function basic_email() {
        $data = array('name'=>"Deepali Joshi");
     
        Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('at.deepalijoshi@gmail.com', 'Tutorials Point')->subject
              ('Laravel Basic Testing Mail');
           $message->from('email@arthtechnology.com','Deepali Joshi');
        });
        echo "Basic Email Sent. Check your inbox.";
        print_r('$data');
        return;
     }
     public function html_email() {
        $data = array('name'=>"Deepali Joshi");
        Mail::send('mail', $data, function($message) {
           $message->to('at.deepalijoshi@gmail.com', 'Tutorials Point')->subject
              ('Laravel HTML Testing Mail');
           $message->from('email@arthtechnology.com','Deepali Joshi');
        });
        echo "HTML Email Sent. Check your inbox.";
     }
     public function attachment_email() {
        $data = array('name'=>"Deepali Joshi");
        Mail::send('mail', $data, function($message) {
           $message->to('at.deepalijoshi@gmail.com', 'Tutorials Point')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\tms\public\dist\img\photo2.png');
           $message->attach('C:\tms\public\dist\img\photo1.png');
           $message->from('email@arthtechnology.com','Deepali Joshi');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }  
}
