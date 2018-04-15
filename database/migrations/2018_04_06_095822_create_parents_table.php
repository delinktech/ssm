<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('parent_first_name');
            $table->string('parent_second_name');
            $table->integer('parent_national_id');
            $table->integer('parent_Phone_number');
            $table->string('parent_email');
            $table->string('parent_county');
            $table->string('parent_sub_county');
            $table->string('parent_ward');

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
        Schema::dropIfExists('parents');
    }
}
