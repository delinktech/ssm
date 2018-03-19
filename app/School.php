<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table='schools';

    protected $fillable=['school_name' , 'school_logo' , 'school_address', 'school_mobile', 'school_email', 'school_county', 'school_town', 'school_level', 'user_id'];
}
