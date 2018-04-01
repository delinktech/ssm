<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_reg')->unique();
            $table->integer('class_id');
            $table->string('student_first_name');
            $table->string('student_second_name');
            $table->string('student_last_surname');
            $table->date('student_dob');
            $table->string('student_gender');
            $table->string('student_parent');
            $table->longText('passport_photo')->nullable();
            $table->string('student_school');
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
        Schema::dropIfExists('students');
    }
}
