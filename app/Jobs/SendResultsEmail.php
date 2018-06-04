<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendResultsEmail implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $result;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($result)
  {
    $this->result = $result;
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle($result)
  {
    Mail::send('emails.results-mail', $result, function($message) use($result) {
      $message->to($result['result']->parentEmail->parent_email)
              ->subject($result['result']->studentIfo->student_first_name . ' Term ' . $result['result']->term . ' Results')
              ->from($result['result']->schoolInfo->school_email, $result['result']->schoolInfo->school_name);
    });
  }
}
