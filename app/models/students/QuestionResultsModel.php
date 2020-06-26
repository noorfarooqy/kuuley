<?php

namespace App\models\students;

use Exception;
use Illuminate\Database\Eloquent\Model;

class QuestionResultsModel extends Model
{
    //
    protected $table = "question_results";
    protected $fillable = [
        "quiz_id",
        "question_id",
        "chosen_answer",
        "student_id",
        "trial_count",
        "trail_completed"
    ];

    public $question_three_progress = false; //helps to track when adding multiple answers to question type 3
    protected $error_message = null;

    public function AnswerQuestion($question, $answer, $student)
    {
        $question_id = $question->id;
        $quiz_id = $question->quiz_id;
        $existing_trail = $this->where([
            ['question_id', $question_id],
            ['quiz_id', $quiz_id],
            ['student_id', $student],
            ['trail_completed', false]
        ])->get();

        try {
            if (!$this->question_three_progress)
                foreach ($existing_trail as $key => $trial) {

                    $trial->delete();
                }
            return $this->create([
                "quiz_id" => $quiz_id,
                "question_id" => $question_id,
                "chosen_answer" => $answer,
                "student_id" => $student

            ]);
        } catch (Exception $th) {
            $this->error_message = $th->getMessage();
            return false;
        }
    }

    public function getError()
    {
        return $this->error_message;
    }
}
