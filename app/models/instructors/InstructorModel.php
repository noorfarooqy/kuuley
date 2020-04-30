<?php

namespace App\models\instructors;

use Illuminate\Database\Eloquent\Model;

class InstructorModel extends Model
{
    //
    protected $table = "instructor_info";
    protected $fillable = [
        "instructor_id",
        "inst_firstname",
        "inst_secondname",
        "inst_lastname",
        "inst_living_country",
        "inst_living_city",
        "inst_living_address",
        "inst_nationality",
        "inst_telephone",
        "inst_telephone_two",
        "inst_is_female",
        "inst_specialization",
        "inst_is_active",
    ];
}
