<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(App\Models\Teacher::class, 30)->create();
  }
}
