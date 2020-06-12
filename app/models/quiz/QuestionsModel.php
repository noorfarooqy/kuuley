<?php

namespace App\models\quiz;

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
    ];
    protected $error = null;
    public $trueOrFalseType = 1;
    public $singChoiceQuestion = 2;
    public $multiChoiceQuestion = 3;

    public function NewTrueOrFalseQuestion($data, $quiz_id)
    {
        try {
            $question =  $this->create([
                "quiz_id" => $quiz_id,
                "question_text" => $data["question_text"],
                "question_type" => $this->trueOrFalseType,
            ]);
            $AnswerModel = new AnswersModel();
            $Answer = $AnswerModel->AddAnswer($data["answers"], $question);
            if(!$Answer){
                $question->delete();
                $this->error = $AnswerModel->getError();
                return false;
            }
            return $question;
        } catch (Exception $e) {
            //throw $th;
            $this->error = $e->getMessage();
        }
    }

    public function Answers()
    {
        return $this->hasMany(AnswersModel::class, 'question_id','id');
    }

    public function getError(){
        return $this->error;
    }
}
