<?php

namespace App\models\courses;

use Exception;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollsModel extends Model
{
    //
    protected $table = 'course_enrolls';
    protected $fillable = [
        "student_id",
        "course_id",
        "enroll_status",
        "handled_by",
        "has_completed"
    ];
    protected $error_message = null;
    public $status_review = 10;
    public $status_rejected = 20;
    public $status_approved = 30;

    public function RequestToEnroll($student, $course)
    {
        try {
            return $this->create([
                "student_id" => $student,
                "course_id" => $course,
                "enroll_status" => $this->status_review,

            ]);
        } catch (Exception $th) {
            $this->error_message = $th->getMessage();
            return false;
        }
    }
    public function courseInfo()
    {
        return $this->belongsTo(CoursesModel::class, 'course_id', 'id');
    }
    public function getError()
    {
        return $this->error_message;
    }
}
