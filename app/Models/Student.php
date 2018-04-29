<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $table='students';

  protected $primaryKey='id';

  protected $fillable=['student_reg','class_id','student_first_name','student_second_name','student_last_surname','student_dob','student_gender','student_parent','passport_photo','student_school'];
 
  public function studentParent()
  {
    return $this->hasOne('App\Models\Parent', 'foreign_key');
  }

  public function studentSchool()
  {
    return $this->belongsToMany('App\Models\School');
  }

  public function studentTeacher(){
    return $this->belongsToMany('App\Models\Teacher');
  }

  public function studentResults()
  {
    return $this->hasMany('App\Models\Results'); 
  }

  public function getName(){
    return $this->student_first_name." ".$this->student_last_surname;
  }
}
