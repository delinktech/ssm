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
            $table->text('first_name');
            $table->text('teacher_surname');
            $table->text('teacher_id_number');
            $table->text('teacher_email');
            $table->text('teacher_dev_reg')->nullable();
            $table->text('teacher_api_session')->nullable();
            $table->text('teacher_password')->nullable();
            $table->integer('teacher_status')->nullable();
            $table->integer('teacher_school_id');
            $table->integer('teacher_class_id');
            $table->string('subjects_id');
            $table->integer('teacher_user_id');
            $table->text('teacher_code')->nullable();
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
