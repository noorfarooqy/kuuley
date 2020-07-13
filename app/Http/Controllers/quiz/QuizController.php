<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use App\models\courses\LessonsModel;
use App\models\quiz\AnswersModel;
use App\models\quiz\QuestionsModel;
use App\models\quiz\QuizesModel;
use App\models\students\QuestionResultsModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
        if ($admin->quiz_permission < $admin->perm_write) {
            if ($request->expectsJson())
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
            "has_course" => isset($data["quiz_course"]),
            "course_id" => $data["quiz_type"] == 2 ? $data["quiz_course"] : null,
            "is_diagnostic" => $data["quiz_type"] == 1,
            "created_by" => $admin->user_id,
        ]);

        if ($request->expectsJson()) {
            return Response()->json([
                "success_message" => false,
                "data" => $newQuiz,
                "error_message" => "Successfully created new quiz"
            ]);
        }
        return redirect()->to('/admin/quiz/' . $newQuiz->id);
    }

    public function ViewGivenQuiz(Request $request, $quiz_id)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->quiz_permission < $admin->perm_write) {
            if ($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }

        $quiz = QuizesModel::where("id", $quiz_id)->get();
        abort_if($quiz == null || $quiz->count() <= 0, 404);
        $quiz = $quiz[0];
        return view('quiz.view_quiz', compact('quiz'));
    }
    public function GetQuizQuestions(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->quiz_permission < $admin->perm_read) {
            if ($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        $validated = Validator::make($request->all(), [
            "quiz_id" => "required|integer|exists:quizes,id",
        ]);
        if ($validated->fails()) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => $validated->errors()->first()]);
        }
        $quiz = QuizesModel::where("id", $request->quiz_id)->with('Questions', 'Questions.Answers')->get();
        if ($quiz == null || $quiz->count() <= 0) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "could not find the quiz"], 404);
        }
        $questions = $quiz[0]->Questions;

        return Response()->json(["success_message" => true, "data" => $questions]);
    }
    public function GetQuizQuestionsForStudent(Request $request)
    {
        $user = $request->user();
        if (!$user->is_student) {
            if ($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        $validated = Validator::make($request->all(), [
            "lesson_id" => "required|integer|exists:lessons,id",
        ]);
        if ($validated->fails()) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => $validated->errors()->first()]);
        }
        $lesson = LessonsModel::where('id', $request->lesson_id)->get();
        if ($lesson == null || $lesson->count() <= 0) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "could not find the lesson info"], 404);
        } else if ($lesson[0]->lesson_type != 30) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "The lesson type is not assignment"], 200);
        }
        $quiz = $lesson[0]->Assignment;

        // return [$quiz, $lesson];
        if ($quiz == null || $quiz->count() <= 0) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "could not find the quiz"], 404);
        }
        $Trails = $quiz->Trials->where('trail_completed', true)->where('student_id', $user->id);

        // $trail_result = new Collection();
        $trail_result = $this->CalculatePerformance($Trails);
        $questions = $quiz->Questions;


        // $trail_result["total"] = $questions->count();
        foreach ($questions as $key => $question) {

            $question->Answers;
            $answers = $question->ResultsSubmitted->where('trail_completed', false);
            if ($question->question_type == 3) {
                $results = [];
                foreach ($answers as $akey => $answer) {
                    array_push($results, $answer->chosen_answer);
                }
                $questions[$key]->answer = $results;
            } else
                $questions[$key]->answer = $answers == null || $answers->count() <= 0 ? null : $answers[0]->chosen_answer;
        }
        return Response()->json(["success_message" => true, "data" => [$questions, $trail_result]]);
    }


    public function NewQuestion(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->quiz_permission < $admin->perm_write) {
            if ($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        // return [(int)$request->question_type ==  1, 'what'];
        $rules = [
            "question_type" => "required|integer|in:1,2,3",
            "question_text" => "required|string|max:1200|min:3",
            "quiz_id" => "required|integer|exists:quizes,id",
            "related_topic" => "required|integer|exists:courses,id",
            "related_lesson" => "nullable|integer|exists:lessons,id"
        ];
        if ($request->question_type >= 2) {
            $rules["answers"] = "required|array";
            $rules["answers.*.answer"] = "required|string";
            $rules["answers.*.is_correct"] = "required|boolean";
        } else
            $rules["answers"] = "required|boolean";

        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => $validated->errors()->first()]);
        }
        $QuizModel = QuizesModel::where("id", $request->quiz_id)->get();
        if ($QuizModel == null || $QuizModel->count() <= 0) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "could not find the quiz"], 404);
        }
        $QuizModel = $QuizModel[0];
        // return $validated->validated()["question_t"];
        $data = $validated->validated();
        if ($request->question_type >= 2) {
            $has_correct = false;
            foreach ($data["answers"] as $key => $answer) {
                # code...
                if ($answer["is_correct"])
                    $has_correct = true;
            }
            if (!$has_correct)
                return $this->ResponseError("Please provide at least one correct answer");
        }
        $NewQuestion = $QuizModel->AddNewQuestion($data);
        if ($NewQuestion == false || $NewQuestion == null) {
            return $this->ResponseError("Failed to add the new question. Contact Adminstrator for assistance", $QuizModel->getError());
        }
        $answers = $NewQuestion->Answers;
        return Response()->json(["success_message" => true, "data" => $NewQuestion]);
    }

    public function DeteleQuestion(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->quiz_permission < $admin->perm_delete) {
            if ($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        $validated = Validator::make($request->all(), [
            "question" => "required|integer|exists:questions,id",
            "quiz_id" => "required|integer|exists:quizes,id",
        ]);
        if ($validated->fails()) {
            return Response()->json([
                "success_message" => false,
                "data" => [],
                "error_message" => $validated->errors()->first(),
                "error_description" => "",
            ]);
        }
        $data = $validated->validated();
        $Question = QuestionsModel::where([
            ["quiz_id", $data["quiz_id"]],
            ["id", $data["question"]],
        ])->get();
        if ($Question == null || $Question->count() <= 0) {

            return Response()->json([
                "success_message" => false,
                "data" => [],
                "error_message" => "The question could not found in the particular quiz",
                "error_description" => "",
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

    public function GetQuizAssignments(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->quiz_permission < $admin->perm_read) {
            if ($request->expectsJson())
                return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
            abort(403);
        }
        $validated = Validator::make($request->all(), [
            "course_id" => "required|integer|exists:courses,id",
        ]);
        if ($validated->fails()) {
            return Response()->json([
                "success_message" => false,
                "data" => [],
                "error_message" => $validated->errors()->first(),
                "error_description" => "",
            ]);
        }
        $quizes = QuizesModel::where('course_id', $request->course_id)->get();
        if ($quizes == null || $quizes->count() <= 0) {

            return Response()->json([
                "success_message" => false,
                "data" => [],
                "error_message" => "The assignments for the selected quiz could not be found",
                "error_description" => "",
            ]);
        }


        return Response()->json([
            "success_message" => true,
            "data" => $quizes
        ]);
    }


    public function OpenQuizReport(Request $request, $quiz_id, $trail_count)
    {
        $user = $request->user();
        abort_if(!$user->is_student, 403);

        $quiz = QuizesModel::where('id', $quiz_id)->get();
        abort_if($quiz == null || $quiz->count() <= 0, 404, 'Could not find the quiz for this trail');

        $trail = QuestionResultsModel::where([
            ['trail_count', $trail_count],
            ['quiz_id', $quiz_id],
            ['student_id', $user->id]
        ])->get();
        abort_if($trail == null || $trail->count() <= 0, 403, 'There are no reports for this quiz.');
        $quiz = $quiz[0];

        abort_if($trail == null || $trail->count() <= 0, 404, 'Could not find the trail report of the quiz');

        return view('student.quiz_report', compact('user', 'quiz', 'trail'));
    }


    // api


    public function AnswerQuestion(Request $request)
    {
        $user = $request->user();

        if (!$user->is_student) {
            return $this->ResponseError('Permission denied.');
        }

        $rules = [
            "question_id" => "required|integer|exists:questions,id",
            "answer" => "required",
            "question_type" => "nullable|integer|in:2"
        ];

        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return $this->ResponseError($validated->errors()->first());
        }
        $data = $validated->validated();
        $question = QuestionsModel::where('id', $request->question_id)->get()[0];
        if ($question->is_deleted)
            return $this->ResponseError('The particular queston does not exist or has been deleted ');
        $lesson = LessonsModel::where('assignment_id', $question->quiz_id)->get();
        // return [$lesson];
        if (($lesson == null || $lesson->count() <= 0) && $question->questionQuiz->is_diagnostic == false)
            return $this->ResponseError('The lesson to this assignment could not be found');
        $answers = AnswersModel::where('question_id', $request->question_id)->get();
        if ($answers == null || $answers->count() <= 0)
            return $this->ResponseError('Please ensure you have selected an answer');
        // return [$answers, $data["answer"]];
        if (is_array($data['answer'])) {

            $has_answer = 0;
            foreach ($answers as $key => $answer) {
                if (in_array($answer->id, $data["answer"])) {
                    $has_answer = $has_answer + 1;
                }
            }
            if ($has_answer != count($data["answer"])) {
                return $this->ResponseError('The answer you have given does not match with the question answers. ');
            }

            // return [$has_answer, "array type answer"];
        } else if ($question->question_type === 1) {
            if ($data["answer"] != true && $data["answer"] != false)
                return $this->ResponseError('The answer you have provided is invalid');
        } else if (!AnswersModel::where([
            ['id', $data["answer"]], ['question_id', $question->id]
        ])->exists()) {
            return $this->ResponseError('The answer you have given couldnt be found in the question choices');
        }

        $AnswerResultModel = new QuestionResultsModel();

        $results = [];
        if (is_array($data["answer"])) {
            foreach ($data["answer"] as $key => $answer) {
                $AnswerResultModel->question_three_progress = $question->question_type == 3 && $key > 0;
                $is_correct = AnswersModel::where('id', $answer)->get();
                if ($is_correct == null || $is_correct->count() <= 0) {
                    foreach ($results as $key => $result) {
                        $result->delete();
                    }

                    return $this->ResponseError(
                        'Could not verify whether your answer is correct or not. Please contact support',
                    );
                }
                // array_push($results, $AnswerResultModel->question_three_progress);
                $new_result = $AnswerResultModel->AnswerQuestion($question, $answer, $user->id, $is_correct[0]->is_correct);
                if (!$new_result) {
                    foreach ($results as $key => $result) {
                        $result->delete();
                    }

                    return $this->ResponseError(
                        'Failed to save the new answer to your question',
                        $AnswerResultModel->getError()
                    );
                }
                array_push($results, $new_result);
            }
        } else {
            if ($question->question_type == 1)
                $is_correct = AnswersModel::where('question_id', $question->id)->get();
            else
                $is_correct = AnswersModel::where('id', $data["answer"])->get();
            if ($is_correct == null || $is_correct->count() <= 0) {
                foreach ($results as $key => $result) {
                    $result->delete();
                }

                return $this->ResponseError(
                    'Could not verify whether your answer is correct or not. Please contact support.',
                );
            } else {
                if ($question->question_type == 1)
                    $is_correct = $is_correct[0]->answer_bool == $data["answer"];
                else
                    $is_correct = $is_correct[0]->is_correct;
            }
            $new_result = $AnswerResultModel->AnswerQuestion($question, $data['answer'], $user->id, $is_correct);
            if (!$new_result) {
                return $this->ResponseError(
                    'Failed to save the new answer to your question',
                    $AnswerResultModel->getError()
                );
            }
        }

        return $this->ResponseSuccess($results, 'successully saved the answer');
    }
    public function SubmitQuiz(Request $request)
    {
        $user = $request->user();
        if (!$user->is_student)
            return $this->ResponseError("Permission denied. ");

        $rules = [
            "assignment_id" => "required|integer|exists:quizes,id"
        ];
        $validated = Validator::make($request->all(), $rules);
        if ($validated->fails()) {
            return $this->ResponseError($validated->errors()->first());
        }
        $data = $validated->validated();

        $Assignemnt = QuizesModel::where('id', $data["assignment_id"])->get();
        if ($Assignemnt == null || $Assignemnt->count() <= 0) {
            return $this->ResponseError('The assignment could not be found');
        }

        $Questions = $Assignemnt[0]->Questions;
        if ($Questions == null || $Questions->count() <= 0) {
            return $this->ResponseError('Could not get the list of question for the given assignment. Contact support');
        }
        $completed = [];
        foreach ($Questions as $key => $question) {
            $trails = QuestionResultsModel::where([
                ['question_id', $question->id],
                ['trail_completed', false]
            ])->get();
            if ($trails == null || $trails->count() <= 0) {
                foreach ($completed as $key => $trail) {
                    //found incomplete /missing questions answer, reset the trail count and the completed status
                    $trail->update(["trail_completed" => false, 'trail_count' => $trail->trail_count - 1]);
                }
                return $this->ResponseError(
                    'Missing question(s), please ensure that you have answered all the questions and saved before submitting the assignment'
                );
            } else {
                foreach ($trails as $key => $trail) {
                    $trail->update(['trail_completed' => true, 'trail_count' => ($trail->trail_count + 1)]);
                    array_push($completed, $trail);
                }
            }
        }
        return $this->ResponseSuccess([]);
    }

    public function GetDiagnosticQuizQuestions(Request $request)
    {
        $user = $request->user();
        if (!$user->is_student)
            return $this->ResponseError("Permission denied. ");

        $rules = [
            "quiz" => "required|integer|exists:quizes,id"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return $this->ResponseError($validator->errors()->first());
        $quiz = QuizesModel::where('id', $request->quiz)->get()[0];
        if ($quiz == null || $quiz->count() <= 0)
            return $this->ResponseError('The selected diagnostic quiz could not be verified');
        $Trails = $quiz->Trials;
        if ($Trails != null)
            $Trails = $Trails->where('trail_completed', true);
        $questions = $quiz->Questions;
        foreach ($questions as $key => $question) {

            $question->Answers;
            $answers = $question->ResultsSubmitted->where('trail_completed', false);
            if ($question->question_type == 3) {
                $results = [];
                foreach ($answers as $akey => $answer) {
                    array_push($results, $answer->chosen_answer);
                }
                $questions[$key]->answer = $results;
            } else
                $questions[$key]->answer = $answers == null || $answers->count() <= 0 ? null : $answers[0]->chosen_answer;
        }
        return $this->ResponseSuccess([$questions, $this->CalculatePerformance($Trails)]);
    }

    public function GetQuizReport(Request $request)
    {
        $user = $request->user();

        $rules = [
            "quiz" => "required|integer|exists:quizes,id",
            "trail_count" => "required|integer|exists:question_results,trail_count"
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return $this->ResponseError($validator->errors()->first());
        }
        $data = $validator->validated();
        $questions = QuestionsModel::where('quiz_id', $data["quiz"])->with('answers')->get();

        if ($questions == null || $questions->count() <= 0) {
            return $this->ResponseError('Failed to get the questions for this quiz report');
        }
        $trail = QuestionResultsModel::where([
            ['quiz_id', $data["quiz"]],
            ['trail_count', $data["trail_count"]],
            ['student_id', $user->id],
            ['trail_completed', true]

        ])->get();

        if ($trail == null || $trail->count() <= 0) {
            return $this->ResponseError('The quiz results could not be found. Ensure you have submitted the answers');
        }

        return $this->ResponseSuccess(["questions" => $questions, "trail" => $trail, "results" => $this->CalculatePerformance($trail)]);
    }

    protected function ResponseError($error, $error_description = null)
    {
        return Response()->json([
            "success_message" => false,
            "data" => [],
            "error_message" => $error,
            "error_description" => $error_description
        ]);
    }
    protected function ResponseSuccess($data, $message = 'successful')
    {
        return Response()->json([
            "success_message" => $message,
            "data" => $data
        ]);
    }

    protected function CalculatePerformance($Trails)
    {
        $trail_result = [];
        $trail_list = [];
        $first_time = Carbon::now();
        $topic = [];
        //at the time of adding the topic result tracking, 
        // there was a mysterious problem and the in_array for assoc keeps returnning false
        //so i had to create the topic_tracker_index solve that way
        $topic_track_index = [];
        foreach ($Trails as $key => $trail) {

            $question = $trail->Question;
            //if corresponding question details are not found for whatever reason,
            //then topic analaysis cannot be done, so just set it to null
            if ($question != null && $question->count() > 0) {
                $course = $question->CourseRelated;
                if (!in_array(hash('md5', $course->id), $topic_track_index)) {
                    array_push($topic, [
                        "topic_name" => $course->course_name,
                        "topic_hash" => hash('md5', $course->id),
                        "topic_total" => 1,
                        "topic_result" => $trail->is_correct_choice ? 1 : 0,
                    ]);
                    array_push($topic_track_index, hash('md5', $course->id));
                } else {
                    $index = array_search(hash('md5', $course->id), $topic_track_index);
                    $topic[$index]["topic_total"] += 1;
                    if ($trail->is_correct_choice)
                        $topic[$index]["topic_result"] =  $topic[$index]["topic_result"] + 1;
                }
            }

            if (in_array($trail->trail_count, $trail_list)) {
                $index = array_search($trail->trail_count, $trail_list);
                if ($trail->is_correct_choice) {
                    $trail_result[$index]["result"] += 1;
                }
                $trail_result[$index]["total"] += 1;
                $trail_result[$index]["time"] = gmdate('H:i:s', ($trail->updated_at->diffInSeconds($first_time)));
            } else {
                $result = 0;
                if ($trail->is_correct_choice) {
                    $result = 1;
                }
                $date = $trail->updated_at->format('Y-m-d H:i:s');
                array_push($trail_result, [
                    "date" => $date,
                    "result" => $result,
                    "total" => 1,
                    "quiz" => $trail->quiz_id,
                    "trail" => $trail->trail_count,
                    "created_at" => $trail->created_at,
                    "time" => $trail->created_at->diffInMinutes($trail->updated_at)
                ]);
                $first_time = $trail->created_at;
                array_push($trail_list, $trail->trail_count);
            }
        }

        return ["trail_result" => $trail_result, "topic_result" => $topic];
    }
}
