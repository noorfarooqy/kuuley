<?php

namespace App\models\quiz;

use Exception;
use Illuminate\Database\Eloquent\Model;

class AnswersModel extends Model
{
    //
    protected $table = "answers";
    protected $fillable = [
        "question_id",
        "answer_text",
        "answer_bool",
        "is_correct",
    ];
    protected $error = null;
    public function AddAnswer($answers, $question)
    {
        if($question->question_type == $question->trueOrFalseType){
            try {
                $new_answer =  $this->create([
                    "question_id" => $question->id,
                    "answer_bool" => $answers,
                    "is_correct" => true,
                ]);
                return $new_answer;
            } catch (Exception $e) {
                //throw $th;
                $this->error = $e->getMessage();
                return false;
            }
        }
        
    }
    public function getError(){
        return $this->error;
    }
}
