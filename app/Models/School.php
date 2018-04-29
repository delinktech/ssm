<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table='schools';

    protected $primaryKey='id';

    protected $fillable=['school_name' ,'reg_no', 'school_logo' , 'school_address', 'school_mobile', 'school_email', 'school_county', 'school_town', 'school_level', 'user_id', 'createdBy', 'updatedBy'];

    public function studentSchool(){
      return $this->hasMany('App\Models\Student');
    }

    public function schoolTeacher(){
      return $this->hasMany('App\Models\Teacher');
    }

    public function schoolUser(){
      return $this->hasMany('App\Models\User');
    }
}
