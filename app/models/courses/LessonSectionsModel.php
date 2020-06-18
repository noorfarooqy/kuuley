<?php

namespace App\models\courses;

use Exception;
use Illuminate\Database\Eloquent\Model;

class LessonSectionsModel extends Model
{
    protected $table = 'lesson_sections';

    protected $fillable = [
        'course_id',
        'section_name',
        'created_by',
        'is_active',
    ];
    protected $error_message = null;

    public function NewSection($data, $course, $creator)
    {
        try {
            //code...
            return $this->create([
                'course_id' => $course,
                'section_name' => $data['sectionName'],
                'created_by' => $creator,
                'is_active' => true,
            ]);
        } catch (Exception $e) {
            $this->error_message = $e->getMessage();

            return false;
        }
    }

    public function NewLesson($data, $uploaded_file, $mimetype, $assignment)
    {
        $lessonModel = new LessonsModel();
        $new_lesson = $lessonModel->NewLesson($data, $uploaded_file, $mimetype, $assignment, $this->course_id, $this->id);
        $this->error_message = $lessonModel->getError();
        return $new_lesson;
    }
    public function getError()
    {
        return $this->error_message;
    }
}
