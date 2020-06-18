<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use App\models\courses\CoursesModel;
use App\models\courses\LessonSectionsModel;
use App\models\courses\LessonsModel;
use App\models\quiz\QuizesModel;
use Exception;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class LessonsController extends Controller
{
    public function __construct()
    {
        $this->error_message = null;
    }
    public function OpenLessonsPage(Request $request, $course_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->quiz_permission < $admin->perm_read, 403);
        $course = CoursesModel::where('id', $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 403);

        $course = $course[0];

        $sections = LessonSectionsModel::where([
            ['course_id', $course_id],
            ['is_active', true],
        ])->get();

        return view('lessons.add_lesson', compact('course', 'sections'));
    }

    public function AddNewSection(Request $request, $course_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->quiz_permission < $admin->perm_write, 403);

        $course = CoursesModel::where('id', $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 403);

        $course = $course[0];

        $data = $request->validate(['sectionName' => 'required|string|max:255|min:3']);

        $existingSection = LessonSectionsModel::where([
            ['course_id', $course_id],
            ['section_name', $data['sectionName']],
        ])->get();
        if ($existingSection != null && $existingSection->count() > 0) {
            return Redirect::back()->withErrors(['sectionName' => 'Similar section with same name exist in this course']);
        } else {
            $section = new LessonSectionsModel();
        }

        $newSection = $section->NewSection($data, $course_id, $admin->user_id);

        if (!$newSection) {
            return Redirect::back()->withErrors(['sectionName', $newSection->getError()]);
        } else {
            return Redirect::back()->with('success', 'Successfully added new section');
        }
    }

    public function AddNewLession(Request $request, $course_id, $update = false)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->quiz_permission < $admin->perm_write, 403);

        $course = CoursesModel::where('id', $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 403);

        $course = $course[0];

        $data = $request->validate($this->GetNewLessonRules());

        if ($data["lessonType"] == 2) {
            $uploaded_file = $this->UploadLessonFile($request, $course);
            if (!$uploaded_file)
                return Redirect::back()->withErrors(['lessonResourceFile' => $this->error_message]);
            $mimetype = Storage::disk('public')->mimeType($uploaded_file);
            $assignment = null;
        } else {
            //ensure the assigment belongs to the given course
            $assignment = $this->GetAssignmentInfo($course_id, $data);
            $assignment = $assignment[0]->id;
            $uploaded_file = null;
            $mimetype = null;
        }
        $section = LessonSectionsModel::where([
            ['id', $data["lessonSection"]],
            ["course_id", $course_id]
        ])->get();
        if ($section == null || $section->count() <= 0) {
            return Redirect::back()->withErrors(['lessonSection' => 'The lesson section doesnt correspond with the given course']);
        }
        $section = $section[0];
        $data["creator"] = $admin->user_id;
        $lesson = $section->NewLesson($data, $uploaded_file, $mimetype, $assignment, $update);
        if ($update) {
            if (!$lesson) {
                $this->error_message = $section->getError();
                return false;
            }
            return $lesson;
        }
        if ($lesson) {
            return Redirect::back()->with('success', 'Successfully added new lesson to the course and section');
        }
        return Redirect::back()->withErrors(['lesson' => $section->getError()]);
    }

    protected function UploadFile($file, $path)
    {
        try {
            // $file = Storage::disk('public')->putAs()
        } catch (Exception $e) {
            //throw $th;
            $this->error_message = $e->getMessage();
            return false;
        }
    }

    public function ViewLessonInfo(Request $request, $course_id, $lesson_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->quiz_permission < $admin->perm_read, 403);

        $course = CoursesModel::where('id', $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 403);

        $course = $course[0];

        $sections = LessonSectionsModel::where([
            ['course_id', $course_id],
            ['is_active', true],
        ])->get();

        $lesson = LessonsModel::where("id", $lesson_id)->get();
        abort_if($lesson == null || $lesson->count() <= 0, 404);
        $lesson = $lesson[0];
        return view('lessons.update_lesson', compact('course', 'sections', 'lesson'));
    }

    public function UpdateLesson(Request $request, $course_id, $lesson_id)
    {

        $updated = $this->AddNewLession($request, $course_id, true);
        if (!$updated) {
            return Redirect::back()->withErrors(['lessonType' => $this->error_message]);
        }
        return Redirect::back()->with('success', 'successfully updated the lesson');
        // $admin = $request->user()->isAdmin;
        // abort_if($admin->quiz_permission < $admin->perm_read, 403);

        // $course = CoursesModel::where('id', $course_id)->get();
        // abort_if($course == null || $course->count() <= 0, 403);

        // $course = $course[0];

        // $lesson = LessonsModel::where("id", $lesson_id)->get();
        // abort_if($lesson == null || $lesson->count() <= 0, 404);

        // $data = $request->validate($this->GetNewLessonRules());

        // if ($data["lessonType"] == 2) {
        //     $uploaded_file = $this->UploadLessonFile($request, $course);
        //     if (!$uploaded_file)
        //         return Redirect::back()->withErrors(['lessonResourceFile' => $this->error_message]);

        //     $mimetype = Storage::disk('public')->mimeType($uploaded_file);
        //     $assignment = null;
        // } else {
        //     //ensure the assigment belongs to the given course
        //     $assignment = $this->GetAssignmentInfo($course_id, $data);
        //     if (!$assignment)
        //         return Redirect::back()->withErrors(['assignmentId' => $this->error_message]);
        //     $assignment = $assignment[0]->id;
        //     $uploaded_file = null;
        //     $mimetype = null;
        // }
        // $sections = LessonSectionsModel::where([
        //     ['id', $data["lessonSection"]],
        //     ["course_id", $course_id],
        //     ['is_active', true],
        // ])->get();
        // if ($sections == null || $sections->count() <= 0) {
        //     return Redirect::back()->withErrors(['lessonSection' => 'The lesson section doesnt correspond with the given course']);
        // }
        // $section = $sections[0];
        // $data["creator"] = $admin->user_id;
        // $updated_lesson = $section->UpdateLesson($data, $uploaded_file, $mimetype, $assignment);

        // if ($updated_lesson) {
        //     return Redirect::back()->with('success', 'Successfully added new lesson to the course and section');
        // }
        // return Redirect::back()->withErrors(['lesson' => $section->getError()]);
    }


    protected function GetNewLessonRules()
    {
        return [
            'lessonTitle' => 'required|string|max:255|min:3',
            'lessonDescription' => 'required|string|max:1200|min:3',
            'lessonIsPublished' => 'nullable|in:on',
            'lessonResourceFile' => 'nullable|file|mimes:mp4,webm,pdf',
            "lessonType" => "required|integer|in:1,2",
            "assignmentId" => "nullable|exists:quizes,id",
            "lessonSection" => "required|integer|exists:lesson_sections,id"
        ];
    }
    protected function UploadlessonFile($request, $course)
    {
        if ($request->file('lessonResourceFile') == null) {
            // return Redirect::back()->withErrors(['The lesson type requires a video or document resource']);
            $this->error_message = 'The lesson type requires a video or document resource';
            return false;
        }
        $path = "uploads/courses/$course->id" . "-$course->course_name/lessons";
        // return $path;
        try {
            $uploaded_file = $request->file('lessonResourceFile')->store($path, 'public');
            return $uploaded_file;
        } catch (Exception $e) {
            return Redirect::back()->withErrors('lessonResourceFile', 'Failed to upload the file - ' . $e->getMessage());
        }
    }

    public function GetAssignmentInfo($course_id, $data)
    {
        $assignment = QuizesModel::where([
            ['id', isset($data["assignmentId"]) ? $data["assignmentId"] : null],
            ['course_id', $course_id]
        ])->get();
        if ($assignment == null || $assignment->count() <= 0) {
            // return Redirect::back()->withErrors(['assignmentId' => 'The given assignment id does not correspond 
            //     to the given course']);
            $this->error_message = 'The given assignment id does not correspond to the given course';
            return false;
        } else if ($assignment[0]->is_deleted) {
            $this->error_message = 'The assignment selected does not exist or is deleted';
            return false;
            // return Redirect::back()->withErrors(['assignmentId' => 'The assignment selected does not exist or is deleted']);
        }
        return $assignment;
    }
}
