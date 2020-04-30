<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;

class AdminsModel extends Model
{
    //
    protected $table = "admins";
    protected $fillable = [
        "user_id",
        "student_permission",
        "instructor_permission",
        "course_permission",
        "admin_permission",
        "blog_permission",
        "kb_permission", //knowledge base
        "settings_permission",
        "forum_permission",
    ];

}
