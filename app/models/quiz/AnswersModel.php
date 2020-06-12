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
        $all_answers = [];
        try {
            
            if($question->question_type == $question->trueOrFalseType){
                $new_answer=$this->CreateAnswer($question->id, null, $answers, true);
            }
            else{
                foreach ($answers as $key => $answer) {
                    # code...
                    $new_answer = $this->CreateAnswer($question->id, $answer["answer"],null,$answer["is_correct"]);
                    array_push($all_answers, $answer);
                }
            }
            return $new_answer;
        } catch (Exception $e) {
            //throw $th;
            $this->error = $e->getMessage();
            foreach ($all_answers as $key => $answer) {
                $answer->delete();
                # code...
            }
            return false;
        }
        
        
    }
    public function getError(){
        return $this->error;
    }

    public function CreateAnswer($question_id, $text, $bool, $is_correct)
    {
        return $this->create([
            "question_id" => $question_id,
            "answer_text" => $text,
            "answer_bool" => $bool,
            "is_correct" => $is_correct,
        ]);
    }
}
