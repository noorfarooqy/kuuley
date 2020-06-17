<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use App\models\courses\CoursesModel;
use App\models\courses\LessonSectionsModel;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Redirect;

class LessonsController extends Controller
{
    public function OpenLessonsPage(Request $request, $course_id)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->quiz_permission < $admin->perm_write) {
            if ($request->expectsJson()) {
                return Response()->json(['success_message' => false, 'data' => [], 'error_message' => 'Permission denied']);
            }
            abort(403);
        }
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
        if ($admin->quiz_permission < $admin->perm_write) {
            if ($request->expectsJson()) {
                return Response()->json(['success_message' => false, 'data' => [], 'error_message' => 'Permission denied']);
            }
            abort(403);
        }

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

    public function AddNewLession(Request $request, $course_id)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->quiz_permission < $admin->perm_write) {
            if ($request->expectsJson()) {
                return Response()->json(['success_message' => false, 'data' => [], 'error_message' => 'Permission denied']);
            }
            abort(403);
        }

        $course = CoursesModel::where('id', $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 403);

        $course = $course[0];

        $data = $request->validate([
            'lessonTitle' => 'required|string|max:255|min:3',
            'lessonDescription' => 'required|string|max:1200|min:3',
            'lessonIsPublished' => 'required|in:on,off',
            'lessonResourceFile' => 'required|file|mimes:mp4,webm,pdf,doc,docx',
        ]);
    }
}
