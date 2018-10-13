<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\School;

class Result extends Model
{
  protected $table='results';

  protected $primaryKey='id';

  protected $fillable=['student', 'class', 'subject', 'marks', 'term', 'type', 'school', 'teacher', 'year'];

  public function studentResults()
  {
    return $this->belongsTo(Student::class);
  }

  public function schoolResults()
  {
    return $this->belongsTo(School::class);
  }
}
