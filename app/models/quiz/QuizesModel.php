<?php

namespace App\models\quiz;

use App\models\courses\CoursesModel;
use Illuminate\Database\Eloquent\Model;

class QuizesModel extends Model
{
        
    protected $table = "quizes";
    protected $fillable = [
        "quiz_title",
        "quiz_instructions",
        "has_course",
        "course_id",
        "is_diagnostic",
        "is_active",
        "is_deleted",
        "created_by",
    ];
    protected $error =null;
    public function GetQuizTypeName(){
        return $this->is_diagnostic ? "Diagnostic Quiz" : "Course Assignment";
    }
    public function GetCourseName(){
        $course = $this->QuizCourseInfo;
        return $course == null ? "Uknown course" : $course->course_name ;
    }

    public function QuizCourseInfo(){
        return $this->belongsTo(CoursesModel::class, 'course_id','id');
    }

    public function Questions(){
        return $this->hasMany(QuestionsModel::class, 'quiz_id','id');
    }

    public function AddNewQuestion($data)
    {
        $QuestionModel = new QuestionsModel();
        if($data["question_type"] == $QuestionModel->trueOrFalseType){
            $newQuestion = $QuestionModel->NewTrueOrFalseQuestion($data, $this->id);
            if(!$newQuestion){
                $this->error = $QuestionModel->getError();
                return true;
            }
            return $newQuestion;
        }
        else {
            $this->error = "Unsupporeted question type";
            return false;
        }
    }

    public function getError(){
        return $this->error;
    }
}
