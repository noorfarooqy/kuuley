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
        "quiz_permission",
    ];

    public $perm_none = 0; //no permission
    public $perm_read = 10; // permission to read resources
    public $perm_write = 20; //permission to write/create resource
    public $perm_edit = 30; //permission to edit resources
    public $perm_delete = 40; //permission to delete resources
    public $perm_diactivate = 50; //permission to deactivate resources
    public $perm_activate = 60; //permission to activate resources

}
