<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $table = 'teachers';

  protected $primaryKey='id';

  protected $casts = [
    'subjects_id' => 'array'
  ];

  protected $fillable = ['teacher_username','teacher_surname','teacher_id_number','teacher_email','teacher_email','teacher_dev_reg','teacher_api_session','teacher_password','teacher_status','teacher_school_id','teacher_class_id','subjects_id','teacher_code'
  ];

  // database relationship 
  public function studentTeacher(){
    return $this->hasMany('App\Student');
  } 

  public function schoolTeacher(){
    return $this->belongsTo('App\School');
  }
}
