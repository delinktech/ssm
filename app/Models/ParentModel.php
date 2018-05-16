<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Student;

class ParentModel extends Model
{
  protected $table='parents';

  protected $primaryKey='id';

  protected $fillable = ['parent_first_name','parent_second_name','parent_national_id','parent_Phone_number','parent_email','parent_county','parent_sub_county','parent_ward'];

  public function parentStudent(){
    return $this->hasMany(Student::class);
  }
}
