<?php

namespace App;

use App\models\admin\AdminsModel;
use App\models\courses\CourseEnrollsModel;
use App\models\instructors\InstructorModel;
use App\models\quiz\QuizesModel;
use App\models\students\StudentDiagnosticsModel;
use App\models\students\StudentInfoModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'is_student', 'profile_photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        $has_admins = AdminsModel::get()->count() > 0;
        if (!$has_admins) {
            $this->RegisterAsAdmin([
                "student_permission" => 60,
                "instructor_permission" => 60,
                "course_permission" => 60,
                "admin_permission" => 60,
                "blog_permission" => 60,
                "kb_permission" => 60, //knowledge base
                "settings_permission" => 60,
                "forum_permission" => 60,
                "quiz_permission" => 60,
            ]);
        }

        return $this->hasOne(AdminsModel::class, 'user_id', 'id');
    }
    public function RegisterAsAdmin($permissions)
    {
        return AdminsModel::create([
            "user_id" => $this->id,
            "student_permission" => $permissions['student_permission'],
            "instructor_permission" => $permissions['instructor_permission'],
            "course_permission" => $permissions['course_permission'],
            "admin_permission" => $permissions['admin_permission'],
            "blog_permission" => $permissions['blog_permission'],
            "kb_permission" => $permissions['kb_permission'], //knowledge base
            "settings_permission" => $permissions['settings_permission'],
            "forum_permission" => $permissions['forum_permission'],
            "quiz_permission" => $permissions['quiz_permission'],
        ]);
    }

    public function InstructorInfo()
    {
        return $this->hasOne(InstructorModel::class, 'instructor_id', 'id');
    }
    public function HasInstructorInfo()
    {
        return $this->InstructorInfo()->count() > 0;
    }


    public function StudentInfo()
    {
        return $this->hasOne(StudentInfoModel::class, 'student_id', 'id');
    }
    public function HasStudentInfo()
    {
        return $this->StudentInfo()->count() > 0;
    }

    public function enrolledCourses()
    {
        return $this->hasMany(CourseEnrollsModel::class, 'student_id', 'id');
    }

    public function Diagnostics()
    {
        return $this->hasMany(StudentDiagnosticsModel::class, 'student_id', 'id');
    }
}
