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
      
      $table->string('school_code');
      $table->string('school_name');
      $table->string('school_level');
      $table->string('school_type');
      $table->string('school_gender');

      $table->string('school_county');
      $table->string('school_sub_county');
      $table->string('school_ward');

      $table->string('school_phone');
      $table->string('school_email');
      $table->string('school_logo');
      
      $table->string('createdBy');
      $table->string('updatedBy');
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
