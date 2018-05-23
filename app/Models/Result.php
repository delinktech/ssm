<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Result extends Model
{
  protected $table='results';

  protected $primaryKey='id';

  protected $fillable=['student_id','term','grade','marks'];

  public function studentResults()
  {
    return $this->belongsTo(Student::class);
  }
}
