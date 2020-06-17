<?php

namespace App\models\courses;

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
    public $lession_assignment = 30;
}
