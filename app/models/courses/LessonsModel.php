<?php

namespace App\models\courses;

use Exception;
use Illuminate\Database\Eloquent\Model;

class LessonsModel extends Model
{
    protected $table = 'lessons';

    protected $fillable = [
        'course_id',
        'section_id',
        'lesson_type',
        'assignment_id',
        'lesson_url',
        'is_active',
        'is_deleted',
        'created_by',
    ];
    public $lesson_video = 10;
    public $lesson_document = 20;
    public $lesson_assignment = 30;

    protected $error_message = null;

    public function NewLesson($data, $uploaded_file, $mimetype, $assignment, $course_id, $section_id)
    {
        try {
            $type = $data["lessonType"];
            if ($type == 2) {
                if ($mimetype == "video/mp4")
                    $lessonType = $this->lesson_video;
                else
                    $lessonType = $this->lesson_document;
            } else
                $lessonType = $this->lesson_assignment;
            return $this->create([
                'course_id' => $course_id,
                'section_id' => $section_id,
                'lesson_type' => $lessonType,
                'assignment_id' => $assignment,
                'lesson_url' => $uploaded_file,
                'is_active' => $data["lessonIsPublished"] == "on" ? true : false,
                'is_deleted' => false,
                'created_by' => $data["creator"],
            ]);
        } catch (Exception $e) {
            //throw $th;
            $this->error_messsage = $e->getMessage();
            return false;
        }
    }

    public function getError()
    {
        return $this->error_message;
    }
}
