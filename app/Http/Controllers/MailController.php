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
      $message
        ->to('delinkdesigns@gmail.com', 'To Kamau')
        ->subject('Test Results');
        ->from('schoolregistrar@gmail.com', 'School');
    });
  }

  // public function sendMail($value='')
  // {
  //   Mail::send('emails.test', [], function ($message) {
  //     $message
  //       ->from('delinkdesigns@gmail.com', 'Delink')
  //       ->to('ngimwan@gmail..com', 'Ngich')
  //       ->subject('From SparkPost with ❤');
  //   });
  // }
}
