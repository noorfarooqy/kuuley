<?php

namespace App\Http\Controllers\courses;

use App\Http\Controllers\Controller;
use App\Http\Controllers\misc\UploadedFilesController;
use App\models\courses\CourseCategoryModel;
use App\models\courses\CoursesModel;
use App\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    //
    public function NewCourseCategory(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_write, 403);

        $rules = [
            "categoryName" => "required|string|min:4|max:75|unique:course_category,category_name",
        ];

        $data = $request->validate($rules);

        $CategoryModel = new CourseCategoryModel();
        $new_cat = $CategoryModel->AddCategory($data, $admin->user_id);

        return Redirect::back()->with('success', 'Successfully created new category');
    }

    public function AddNewCoursePage(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_write, 403);
        $categories = CourseCategoryModel::all();
        return view('courses.new_course', compact('categories'));
    }
    public function AddNewCourse(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_write, 403);
        $rules = $this->GetNewCourseRules();
        $data = $request->validate($rules);

        $path = hash('md5', $admin->user_id);
        $path = "uploads/$path";
        $coursePreview = $this->UploadPreview($data["coursePreview"], $admin->user_id);
        if (!$coursePreview) {
            return Redirect::back()->withErrors(['coursePreview' => 'Failed to upload the course preview image']);
        }

        $data["coursePreview"] = Storage::disk('public')->url($coursePreview);
        $CourseModel = new CoursesModel();
        $new_course = $CourseModel->AddNewCourse($data, $admin->user_id);
        return Redirect::back()->with('success', 'You have successfully added new course');
    }

    public function UpdateCoursesGiven(Request $request, $course_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_edit, 403);
        $course = CoursesModel::where("id", $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 404);
        $course = $course[0];
        $rules = $this->GetNewCourseRules(true);
        $data = $request->validate($rules);
        $course_with_similar_name = CoursesModel::where([
            ["course_name", $request->courseName],
            ["id", "!=", $course_id],
        ])->exists();
        if ($course_with_similar_name) {
            return Redirect::back()->withErrors(['courseName' => "Course with similar name already exists"]);
        }

        if ($request->coursePreview != null) {
            $coursePreview = $this->UploadPreview($data["coursePreview"], $admin->user_id);
            if (!$coursePreview) {
                return Redirect::back()->withErrors(['coursePreview' => 'Failed to upload the course preview image']);
            }

            $data["coursePreview"] = Storage::disk('public')->url($coursePreview);
        }

        $new_course = $course->UpdateCourseInfo($data, $admin->user_id);
        return Redirect::back()->with('success', 'You have successfully updated the course');
    }

    public function ViewCoursesList(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_read, 403);
        $courses = CoursesModel::where("course_is_active", true)->paginate(20);
        return view('courses.course_list', compact('courses'));
    }

    public function ViewInactiveCourses(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_read, 403);
        $courses = CoursesModel::where("course_is_active", false)->paginate(20);
        return view('courses.course_list', compact('courses'));
    }

    public function ViewCoursesGiven(Request $request, $course_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_read, 403);
        $course = CoursesModel::where("id", $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 404);
        $course = $course[0];
        $categories = CourseCategoryModel::all();
        return view('courses.view_course', compact('course', 'categories'));
    }

    public function GetNewCourseRules($update = true)
    {
        $rules = [
            "courseName" => "required|string|max:75|min:4|unique:courses,course_name",
            "courseDescription" => "required|string|max:1200",
            "courseCategory" => "required|integer|exists:course_category,id",
            "published" => "nullable|string|in:on",
            "coursePreview" => "required|file|max:10000|mimes:jpg,png,jpeg",
        ];
        if ($update) {
            $rules["coursePreview"] = "nullable|file|max:10000|mimes:jpg,png,jpeg";

            $rules["courseName"] = "required|string|max:75|min:4";
        }
        return $rules;
    }

    public function UploadPreview($file, $user_id)
    {
        $path = hash('md5', $user_id);
        $path = "uploads/$path";
        $Uploader = new UploadedFilesController();
        $coursePreview = $Uploader->AddNewFile($file, $path);
        return $coursePreview;
    }
    public function ViewCourseLessons(Request $request, $course_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->quiz_permission < $admin->perm_write, 403);

        $course = CoursesModel::where('id', $course_id)->get();
        abort_if($course == null || $course->count() <= 0, 404);

        $course = $course[0];

        $sections = $course->lessonSections;

        return view('lessons.view_lessons', compact('course', 'sections'));
    }


    //api calls

    public function GetInstructorCourseList(Request $request)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->course_permission < $admin->perm_read) {
            return Response()->json(["success_message" => false, "data" => [], "error_message" => "Permission denied"]);
        }

        $courses = CoursesModel::where("course_created_by", $admin->user_id)->get(["id", "course_name"]);

        return Response()->json(["success_message" => true, 'data' => [$courses]]);
    }


    public function getCourseInfo(Request $request)
    {
        $user = $request->user();
        $course = CoursesModel::where([
            ["id", $request->course_id],
        ])->with('Category', 'lessonSections', 'lessonSections.lessons')->get();

        if ($course == null || $course->count() <= 0)
            return $this->ResponseError("The course does not exists.");

        if ($user->is_student) {
            $enroll_info = User::whereHas('enrolledCourses', function ($query) use ($course) {
                $query->where('course_id', $course[0]->id);
            })->get();
            $course[0]->enroll_info = $enroll_info;
            $course[0]->course_progress = 0; //TODO: course progress
            $course[0]->is_enrolled = $enroll_info->count() > 0;
        } else
            $course[0]->is_enrolled = false;
        return $this->ResponseSuccess($course[0]);
    }



    public function ResponseError($error, $error_description = null)
    {
        return Response()->json([
            "success_message" => false,
            "data" => [],
            "error_message" => $error,
            "error_description" => $error_description
        ]);
    }
    public function ResponseSuccess($data)
    {
        return Response()->json([
            "success_message" => true,
            "data" => $data
        ]);
    }
}
