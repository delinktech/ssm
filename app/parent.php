<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parent extends Model
{
    protected $table='parents';

  protected $primaryKey='id';

   public function parentStudent(){
    return $this->hasMany(studentTeacher::class,'student_id','id' 'forign_key');
  }
}
