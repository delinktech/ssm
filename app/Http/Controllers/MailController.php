<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Results;
use App\Models\Parents;
use App\Models\Students;
use Mail;

class MailController extends Controller
{
  /**
  * function to send emails
  */
  public function send()
  {
    Mail::send('emails.send-results',['name','Delink'],function($message){
      $message
        ->to('delinkdesigns@gmail.com', 'To Kamau')
        ->subject('Test Results')
        ->from('schoolregistrar@gmail.com', 'School');
    });
  }

  // public function sendMail($value='')
  // {
  //   Mail::send('emails.send-results', [], function ($message) {
  //     $message
  //       ->from('delinkdesigns@gmail.com', 'Delink')
  //       ->to('ngimwan@gmail..com', 'Ngich')
  //       ->subject('From SparkPost with ❤');
  //   });
  // }
}
