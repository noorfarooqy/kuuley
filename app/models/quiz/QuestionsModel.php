<?php

namespace App\models\quiz;

use App\models\courses\CoursesModel;
use App\models\students\QuestionResultsModel;
use Exception;
use Illuminate\Database\Eloquent\Model;

class QuestionsModel extends Model
{
    //
    protected $table = "questions";
    protected $fillable = [
        "quiz_id",
        "question_text",
        "question_type",
        "is_deleted",
        "question_topic",
        "question_lesson"
    ];
    protected $error = null;
    public $trueOrFalseType = 1;
    public $singChoiceQuestion = 2;
    public $multiChoiceQuestion = 3;

    public function questionQuiz()
    {
        return $this->belongsTo(QuizesModel::class, 'quiz_id', 'id');
    }
    public function NewTrueOrFalseQuestion($data, $quiz_id)
    {
        try {
            $question =  $this->AddQuestion($data, $quiz_id, $this->trueOrFalseType);
            $AnswerModel = new AnswersModel();
            $Answer = $AnswerModel->AddAnswer($data["answers"], $question);
            if (!$Answer) {
                $question->delete();
                $this->error = $AnswerModel->getError();
                return false;
            }
            return $question;
        } catch (Exception $e) {
            //throw $th;
            $this->error = $e->getMessage();
            return false;
        }
    }
    public function NewChoiceQuestion($data, $quiz_id)
    {
        try {
            $question =  $this->AddQuestion($data, $quiz_id, $this->singChoiceQuestion);
            $AnswerModel = new AnswersModel();
            $Answer = $AnswerModel->AddAnswer($data["answers"], $question);
            if (!$Answer) {
                $question->delete();
                $this->error = $AnswerModel->getError();
                return false;
            }
            return $question;
        } catch (Exception $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }

    public function AddQuestion($data, $quiz, $type)
    {
        return $this->create([
            "quiz_id" => $quiz,
            "question_text" => $data["question_text"],
            "question_type" => $type,
            "question_topic" => $data["related_topic"],
            "question_lesson" => isset($data["related_lesson"]) ? $data["related_lesson"] : null,
        ]);
    }

    public function Answers()
    {
        return $this->hasMany(AnswersModel::class, 'question_id', 'id');
    }

    public function CourseRelated()
    {
        return $this->belongsTo(CoursesModel::class, 'question_topic', 'id');
    }

    public function ResultsSubmitted()
    {
        return $this->hasMany(QuestionResultsModel::class, 'question_id', 'id');
    }

    public function getError()
    {
        return $this->error;
    }
}
