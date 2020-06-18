<?php

namespace App\models\courses;

use Illuminate\Database\Eloquent\Model;

class CoursesModel extends Model
{
    //
    protected $table = "courses";

    protected $fillable = [
        "course_name",
        "course_description",
        "course_category",
        "course_is_active",
        "course_created_by",
        "course_preview_image"
    ];

    public function AddNewCourse($data, $creator)
    {
        return $this->create([
            "course_name" => $data["courseName"],
            "course_description" => $data["courseDescription"],
            "course_category" => $data["courseCategory"],
            "course_is_active" => $data["published"] == "on" ? true : false,
            "course_created_by" => $creator,
            "course_preview_image" => $data["coursePreview"]
        ]);
    }


    public function UpdateCourseInfo($data, $creator)
    {
        return $this->update([
            "course_name" => $data["courseName"],
            "course_description" => $data["courseDescription"],
            "course_category" => $data["courseCategory"],
            "course_is_active" => isset($data["published"]) ? true : false,
            "course_preview_image" => isset($data["coursePreview"]) ? $data["coursePreview"] : $this->course_preview_image,
        ]);
    }

    public function lessonSections()
    {
        return $this->hasMany(LessonSectionsModel::class, 'course_id', 'id');
    }

    public function Category()
    {
        return $this->belongsTo(CourseCategoryModel::class, "course_category", "id");
    }
}
