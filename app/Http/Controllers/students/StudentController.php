<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\models\courses\CourseCategoryModel;
use App\models\courses\CoursesModel;
use App\models\misc\CountryModel;
use App\models\students\StudentInfoModel;
use App\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    //

    public function OpenStudentProfile(Request $request)
    {
        $student = $request->user();
        abort_if(!$student->is_student, 404);

        $StudentInfo = $student->StudentInfo;

        // return $StudentInfo;
        $countries = CountryModel::all();
        return view('student.student_info', compact('student', 'StudentInfo', 'countries'));
    }

    public function UpdateBasicInfo(Request $request)
    {
        $student = $request->user();
        abort_if(!$student->is_student, 404);

        $StudentModel = $student->StudentInfo;
        $student_id = $student->id;


        $rules = [
            "first_name" => "required|string|max:255|min:2",
            "second_name" => "required|string|max:255|min:2",
            "last_name" => "required|string|max:255|min:2",
            "biography" => "required|string|max:1200|min:15",
            "nationality" => "required|integer|between:1,246",
            "gender" => "required|integer|in:0,1",
            "profession" => "required|string|max:255"
        ];

        $data = $request->validate($rules);


        if ($student->HasStudentInfo()) {
            $StudentInfo = $StudentModel->updateBasic($data);
        } else {
            $StudentModel = new StudentInfoModel();
            $StudentInfo = $StudentModel->storeInfo($data, $student_id);
        }

        return Redirect::back()->with('success', 'Successfully updated basic information');
    }


    public function UpdateAddressInfo(Request $request)
    {
        $student = $request->user();
        abort_if(!$student->is_student, 404);

        $StudentModel = $student->StudentInfo;
        $student_id = $student->id;

        $rules = [
            "living_country" => "required|integer|between:1,246",
            "living_city" => "required|string|max:255|min:2",
            "living_address" => "required|string|max:255|min:2",
            "telephone" => "required|string|max:255|min:8",
            "telephone_two" => "nullable|string|max:255|min:8",
        ];

        $data = $request->validate($rules);

        if ($student->HasStudentInfo()) {
            $StudentInfo = $StudentModel->updateAddressInfo($data);
        } else {
            $StudentModel = new StudentInfoModel();
            $StudentInfo = $StudentModel->storeInfo($data, $student_id);
        }

        return Redirect::back()->with('success', 'Successfully updated address information');
    }
    public function UpdateSocialInfo(Request $request)
    {
        $student = $request->user();
        abort_if(!$student->is_student, 404);

        $StudentModel = $student->StudentInfo;
        $student_id = $student->id;

        $rules = [
            "facebook" => "nullable|url|max:255|min:10|",
            "youtube" => "nullable|url|max:255|min:10",
            "twitter" => "nullable|url|max:255|min:10",
            "github" => "nullable|url|max:255|min:10",
            "linkedin" => "nullable|url|max:255|min:10",
        ];

        $data = $request->validate($rules);

        if ($student->HasStudentInfo()) {
            $StudentInfo = $StudentModel->updateSocialInfo($data);
        } else {
            $StudentModel = new StudentInfoModel();
            $StudentInfo = $StudentModel->storeInfo($data, $student_id);
        }

        return Redirect::back()->with('success', 'Successfully updated social information');
    }

    public function GetCoursesList(Request $request)
    {
        $student = $request->user();
        abort_if(!$student->is_student, 404);

        $StudentModel = $student->StudentInfo;
        if ($StudentModel == null || $StudentModel->count() <= 0) {
            return Redirect::route('studentProfile');
        }
        $student_id = $student->id;

        return view('student.courses_list', compact('student'));
    }



    // Api functions
    public function GetCoursesListApi(Request $request)
    {
        $student = $request->user();
        if (!$student->is_student) {
            return $this->ResponseError('Student profile not found');
        }
        $categories = CourseCategoryModel::where('is_active', true)->with(['Courses'])->get();

        return $this->ResponseSuccess($categories);
    }

    public function ResponseError($error)
    {
        return Response()->json(["success_message" => false, "data" => [], "error_message" => $error]);
    }
    public function ResponseSuccess($data)
    {
        return Response()->json([
            "success_message" => true,
            "data" => $data
        ]);
    }
}
