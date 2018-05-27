<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('teachers', function (Blueprint $table) {
      $table->increments('id');
      $table->string('tscnumber');
      $table->string('first_name');
      $table->string('teacher_surname');
      $table->string('teacher_id_number');
      $table->string('teacher_email');
      $table->string('teacher_dev_reg')->nullable();
      $table->string('teacher_api_session')->nullable();
      $table->string('teacher_status')->nullable();
      $table->integer('teacher_school_id');
      $table->string('subjects')->nullable();

      $table->string('teacher_username')->nullable();
      $table->string('user')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('teachers');
  }
}
