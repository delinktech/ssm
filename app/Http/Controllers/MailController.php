<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
  /**
  * function to send emails
  */
  public function send()
  {
    Mail::send(['text'=>'mail'],['name','Delink'],function($message){
      $message->to('kamaunewton78@gmail.com', 'To Kamau')->subject('Test Results');
      $message->from('schoolregistrar@gmail.com', 'School');
    });
  }
}
