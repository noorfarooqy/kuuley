<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use App\models\quiz\QuestionsModel;
use App\models\quiz\QuizesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    //
    public function ViewQuizIndexPage(Request $request)
    {
        $admin = $request->user()->AdminInfo;

        return view('quiz.quiz_index');
    }
    public function CreateQuiz(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if($admin->quiz_permission < $admin->perm_write){
            if($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        
        $rules = [
            "quiz_title" => "required|string|max:250|min:3",
            "quiz_instructions" => "required|string|max:1200",
            "quiz_type" => "required|integer|in:1,2",
            "quiz_course" => "nullable|integer|exists:courses,id"
        ];

        $data = $request->validate($rules);

        $newQuiz = QuizesModel::create([
            "quiz_title" => $data["quiz_title"],
            "quiz_instructions" => $data["quiz_instructions"],
            "has_course" => isset($data["quiz_course"]) ,
            "course_id" => $data["quiz_type"] == 2 ? $data["quiz_course"] : null,
            "is_diagnostic" => $data["quiz_type"] == 1,
            "created_by" => $admin->user_id,
        ]);

        if($request->expectsJson()){
            return Response()->json([
                "success_message" => false, 
                "data" => $newQuiz, 
                "error_message" => "Successfully created new quiz"
            ]);
        }
        return redirect()->to('/admin/quiz/'.$newQuiz->id);

    }

    public function ViewGivenQuiz(Request $request, $quiz_id)
    {
        $admin = $request->user()->isAdmin;
        if($admin->quiz_permission < $admin->perm_write){
            if($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }

        $quiz = QuizesModel::where("id", $quiz_id)->get();
        abort_if($quiz == null || $quiz->count() <=0, 404);
        $quiz = $quiz[0];
        return view('quiz.view_quiz', compact('quiz'));
            
    }
    public function GetQuizQuestions(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if($admin->quiz_permission < $admin->perm_read){
            if($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        $validated = Validator::make($request->all(),[
            "quiz_id" => "required|integer|exists:quizes,id",
        ]);
        if($validated->fails()){
            return Response()->json(["success_message" => false, "data" => [], "error_message" => $validated->errors()->first()]);
        }
        $quiz = QuizesModel::where("id", $request->quiz_id)->with('Questions','Questions.Answers')->get();
        if($quiz == null || $quiz->count() <=0){
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "could not find the quiz"],404);
        }
        $questions = $quiz[0]->Questions;
        
        return Response()->json(["success_message" => true, "data" => $questions]);
            
    }

    public function NewQuestion(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if($admin->quiz_permission < $admin->perm_write){
            if($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        // return [(int)$request->question_type ==  1, 'what'];
        $rules =[
            "question_type" => "required|integer|in:1,2,3",
            "question_text" => "required|string|max:1200|min:3",
            "quiz_id" => "required|integer|exists:quizes,id",
        ];
        if($request->question_type >= 2){
            $rules["answers"] = "required|array";
            $rules["answers.*.answer"] = "required|string";
            $rules["answers.*.is_correct"] = "required|boolean";
            
        }
        else
            $rules["answers"] = "required|boolean";

        $validated = Validator::make($request->all(),$rules);
        if($validated->fails()){
            return Response()->json(["success_message" => false, "data" => [], "error_message" => $validated->errors()->first()]);
        }
        $QuizModel = QuizesModel::where("id", $request->quiz_id)->get();
        if($QuizModel == null || $QuizModel->count() <=0){
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "could not find the quiz"],404);
        }
        $QuizModel = $QuizModel[0];
        // return $validated->validated()["question_t"];
        $data = $validated->validated();
        if($request->question_type >= 2){
            $has_correct = false;
            foreach ($data["answers"] as $key => $answer) {
                # code...
                if($answer["is_correct"])
                    $has_correct = true;
            }
            if(!$has_correct)
                return Response()->json([
                    "success_message" => false, 
                    "data" => [], 
                    "error_message" => "Please provide at least one correct answer",
                    "error_description" => '',
                ]);
        }
        $NewQuestion = $QuizModel->AddNewQuestion($data);
        if(!$NewQuestion){
            return Response()->json([
                "success_message" => false, 
                "data" => [], 
                "error_message" => "Failed to add the new question. Contact Adminstrator for assistance",
                "error_description" => $QuizModel->getError(),
            ]);
        }
        $answers = $NewQuestion->Answers;
        return Response()->json(["success_message" => true, "data" => $NewQuestion]);
    }

    public function DeteleQuestion(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if($admin->quiz_permission < $admin->perm_delete){
            if($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        $validated = Validator::make($request->all(),[
            "question" => "required|integer|exists:questions,id",
            "quiz_id" => "required|integer|exists:quizes,id",
        ]);
        if($validated->fails()){
            return Response()->json([
                "success_message" => false, 
                "data" => [], 
                "error_message" => $validated->errors()->first(),
                "error_description" =>"",
            ]);
        }
        $data= $validated->validated();
        $Question = QuestionsModel::where([
            ["quiz_id", $data["quiz_id"]],
            ["id", $data["question"]],
        ])->get();
        if($Question == null || $Question->count() <=0 ){

            return Response()->json([
                "success_message" => false, 
                "data" => [], 
                "error_message" => "The question could not found in the particular quiz",
                "error_description" =>"",
            ]);
        }
        $question = $Question[0];
        $answers = $question->Answers;

        foreach ($answers as $key => $answer) {
            $answer->delete();
        }
        $question->delete();
        return Response()->json(["success_message" => true, "data" => $question]);
    }
}
