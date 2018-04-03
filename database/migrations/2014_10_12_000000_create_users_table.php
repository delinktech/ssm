<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');

      $table->string('user_firstname');
      $table->string('user_lastname');
      $table->string('user_phone');

      $table->string('username')->unique();
      $table->string('email')->unique();
      $table->string('password');

      $table->integer('school');
      $table->boolean('approved');
      $table->string('roles');
      $table->string('level');
      $table->string('avatar');
      $table->boolean('hasTeacherObject');

      $table->rememberToken();

      $table->string('creatdBy');
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
    Schema::dropIfExists('users');
  }
}
