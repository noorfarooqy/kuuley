<?php

namespace App\models\students;

use App\models\quiz\QuestionsModel;
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
        "trail_count",
        "trail_completed",
        'is_correct_choice',
    ];

    public $question_three_progress = false; //helps to track when adding multiple answers to question type 3
    protected $error_message = null;

    public function AnswerQuestion($question, $answer, $student, $is_correct)
    {
        $question_id = $question->id;
        $quiz_id = $question->quiz_id;
        $trail_count = 0;
        $existing_trail = $this->where([
            ['question_id', $question_id],
            ['quiz_id', $quiz_id],
            ['student_id', $student],
            ['trail_completed', false]
        ])->get();
        $completed_trails = $this->where([
            ['quiz_id', $quiz_id],
            ['student_id', $student],
            ['trail_completed', true]
        ])->latest()->get();
        if ($completed_trails->count() > 0) {
            $trail_count =  $completed_trails[0]->trail_count;
        }
        try {
            if (!$this->question_three_progress)
                foreach ($existing_trail as $key => $trial) {

                    $trial->delete();
                }
            return $this->create([
                "quiz_id" => $quiz_id,
                "question_id" => $question_id,
                "chosen_answer" => $answer,
                "student_id" => $student,
                'is_correct_choice' => $is_correct,
                'trail_count' => $trail_count

            ]);
        } catch (Exception $th) {
            $this->error_message = $th->getMessage();
            return false;
        }
    }

    public function Question()
    {
        return $this->belongsTo(QuestionsModel::class, 'question_id', 'id');
    }

    public function getError()
    {
        return $this->error_message;
    }
}
