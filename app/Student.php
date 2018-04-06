<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $table='students';

  protected $primaryKey='id';

  protected $fillable=['student_reg','class_id','student_first_name','student_second_name','student_last_surname','student_dob','student_gender','passport_photo','student_school'];

 
  public function studentParent()
  {
    return $this->hasOne('App\Parent', 'foreign_key');
  }

  public function studentSchool()
  {
   return $this->belongsToMany('App\School');
  }

  public function studentTeacher(){
   return $this->belongsToMany('App\Teacher');
  }

  public function studentResults()
  {
      return $this->hasMany('App\Results'); 
 }

  public function getName(){
    return $this->first_name." ".$this->other_name;
  }
}
