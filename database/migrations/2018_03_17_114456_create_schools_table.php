<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('schools', function (Blueprint $table) {
      $table->increments('id');
      
      $table->text('school_code');
      $table->text('school_name');
      $table->integer('school_level');
      $table->integer('school_type');
      $table->text('school_gender');

      $table->text('school_county');
      $table->text('school_sub_county');
      $table->text('school_ward');

      $table->text('school_phone');
      $table->text('school_email');
      $table->text('school_logo');
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
    Schema::dropIfExists('schools');
  }
}
