<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class ClassModel extends Model
{
  protected $table = 'classes';
  protected $fillable = ['name','code','classteacher','school'];

  public function student()
  {
  	return $this hasMany(Student::class);
  }
}
