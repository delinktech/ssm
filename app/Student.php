<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table='students';

    protected $primaryKey='student_id';

    protected $fillable=['student_reg','class_id','student_first_name','student_second_name','student_last_surname','student_dob','student_gender','passport_photo','student_school'];




    public function studentClass()
    {
        return $this->hasOne(Stream::class, 'id', 'class_id');
    }
    public function studentGroups()
    {
        return $this->hasMany(StudentGroupMember::class, 'student_id', 'id');
    }
    public function studentSubjects(){
        return $this->hasMany(StudentSubject::class,'student_id','id');
    }
    public function studentResults(){
        return $this->hasMany(StudentResults::class,'student_id','id');
    }
    public function getName(){
        return $this->first_name." ".$this->other_name;
    }
}
