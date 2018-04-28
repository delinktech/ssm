<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateProfile
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
      //
  }

  /**
   * Handle the event.
   *
   * @param  UserRegistered  $event
   * @return void
   */
  public function handle(UserRegistered $event)
  {
    $profile = new Profile();

    $profile->firstname = 'Derick';
    $profile->lastname = 'Mwangi';

    $event->user->profile()->save($profile);
  }
}
