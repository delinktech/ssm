<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\School;

class Teacher extends Model
{
  protected $table = 'teachers';

  protected $primaryKey='id';

  protected $casts = [
    'subjects' => 'array'
  ];

  protected $fillable = ['tscnumber','first_name','teacher_surname','teacher_id_number','teacher_email','teacher_dev_reg','teacher_api_session','teacher_status','teacher_school_id','subjects','teacher_username','user'
  ];

  // database relationship
  public function studentTeacher(){
    return $this->hasMany(Student::class);
  }

  public function schoolTeacher(){
    return $this->belongsTo(School::class);
  }
}
