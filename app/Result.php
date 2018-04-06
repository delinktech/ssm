<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
   protected $table='results';

  protected $primaryKey='id';

  protected $fillable=['student_id','grade','marks'];


    public function studentResults()
  {
    return $this->hasOne(Student::class, 'id', 'student_id' 'forign-key');
  }
}
