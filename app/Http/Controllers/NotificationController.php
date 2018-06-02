<?php

namespace App\Http\Controllers;

use Mail;
use JWTAuth;
use App\Models\Result;
use App\Models\School;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\ParentModel;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function notifyByEmail(Request $request) {
    $year = $request->input('year');
    $term = $request->input('term');
    $cls = $request->input('class');

    // get school info
    $schId = JWTAuth::parseToken()->toUser()->school;
    $school = School::select('school_name','school_email')->where('id', $schId)->get()->first();

    // fetch results
    $results = Result::where('year', $year)->where('class', $cls)->where('term', $term)->get();

    // loop each record and fetch extra info
    foreach ($results as $key => $value) {
      // get the student info and parent email
      $student = Student::select('student_reg', 'student_first_name', 'class_id', 'student_parent')->where('student_reg', $value->student)->get()->first();
      $cls = ClassModel::select('code', 'name')->where('id', $student->class_id)->get()->first();
      $email = ParentModel::select('parent_email')->where('id', $student->student_parent)->get()->first();

      $value->studentIfo = $student;
      $value->classInfo = $cls;
      $value->parentEmail = $email;
      $value->schoolInfo = $school;

      $data = array( 'result' => $value );

      // return $data;
      // call function to send emails to parent
      $this->sendEmail($data);
    }
  }

  /**
   * function to send email
   */
  private function sendEmail($result) {
    Mail::send('emails.results-mail', $result, function($message) use($result) {
      $message->to($result['result']->parentEmail->parent_email)
              ->subject($result['result']->studentIfo->student_first_name . ' Term ' . $result['result']->term . ' Results')
              ->from($result['result']->schoolInfo->school_email, $result['result']->schoolInfo->school_name);
    });

    // success sent mails
    return response()->json([
      'sent' => true
    ]);
  }

  /*
  public function basic_email(){
    $data = array('name'=>"Virat Gandhi");
    Mail::send(['text'=>'emails.results-mail'], $data, function($message) {
    $message->to('ngichngimwa@gmail.com', 'Tutorials Point')
            ->subject('Laravel Basic Testing Mail')
            ->from('kamaunewton78@gmail.com','Virat Gandhi');
  });
  echo "Basic Email Sent. Check your inbox.";
  }

  public function attachment_email(){
    $data = array('name'=>"Virat Gandhi");
    Mail::send('emails.results-mail', $data, function($message) {
      $message->to('kamaunewton78@gmail.com', 'Tutorials Point')->subject
      ('Laravel Testing Mail with Attachment');
      $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
      $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
      $message->from('kamaunewton78@gmail.com','Virat Gandhi');
    });
    echo "Email Sent with attachment. Check your inbox.";
  }
  */

  // TODO: start using thirdparty mail delivery services
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
