<?php

namespace App\models\students;

use App\models\courses\CoursesModel;
use App\models\quiz\QuestionsModel;
use App\models\quiz\QuizesModel;
use Exception;
use Illuminate\Database\Eloquent\Model;

class StudentDiagnosticsModel extends Model
{
    //
    protected $table = 'student_diagnostics';

    protected $fillable = [
        'student_id',
        'quiz_id',
        'assigned_by',
        'corresponding_course',
        'corresponding_lesson'
    ];
    protected $erorr_message = null;

    protected function Questions()
    {
        return $this->belongsTo(QuizesModel::class, 'quiz_id', 'id');
    }

    public function AssignDiagnostic($data, $student, $creator)
    {
        if ($this->existingDiagnostic($data["diagnostic"], $student)) {
            $this->erorr_message = "The diagnostic already assigned to student";
            return false;
        }
        try {
            return $this->create([
                'student_id' => $student,
                'quiz_id' => $data["diagnostic"],
                'assigned_by' => $creator,
                'corresponding_course' => $data["course"],
                'corresponding_lesson' => isset($data["lesson"]) ? $data["lesson"] : null,
            ]);
        } catch (Exception $th) {
            $this->error_message = $th->getMessage();
            return false;
        }
    }

    protected function existingDiagnostic($diag, $student)
    {
        return $this->where([
            ['quiz_id', $diag],
            ['student_id', $student]
        ])->exists();
    }
    public function QuizInfo()
    {
        return $this->hasOne(QuizesModel::class, 'id', 'quiz_id');
    }

    public function courseInfo()
    {
        return $this->hasOne(CoursesModel::class, 'id', 'corresponding_course');
    }

    // pubic function Trials()

    public function getError()
    {
        return $this->error_message;
    }
}
