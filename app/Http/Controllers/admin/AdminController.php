<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\courses\CourseEnrollsModel;
use App\models\courses\CoursesModel;
use App\models\courses\LessonsModel;
use App\models\instructors\InstructorModel;
use App\models\misc\CountryModel;
use App\models\misc\PasswordResetModel;
use App\models\quiz\QuizesModel;
use App\models\students\StudentDiagnosticsModel;
use App\Notifications\admin\NewAdminNotification;
use App\Notifications\students\AssignedDiagnosticQuestionNotification;
use App\Notifications\students\RequestToEnrollCourseApproved;
use App\Notifications\students\RequestToEnrollCourseRejected;
use App\Notifications\teachers\NewTeacherNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    protected $student_permission;
    protected $instructor_permission;

    public function __construct()
    {
    }

    public function openDashBoard(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->admin_permission < $admin->perm_read, 403);

        return view("admins.dashboard");
    }

    public function openUsersList(Request $request)
    {

        $admin = $request->user()->isAdmin;
        if ($admin->admin_permission < $admin->perm_read) {
            abort(403);
        }

        $users = User::where([
            ["is_student", false],
            ["id", "!=", $request->user()->id],
        ])->get();
        return view("admins.userslist", compact('users'));
    }

    public function ViewStudentsList(Request $request)
    {

        $admin = $request->user()->isAdmin;
        if ($admin->admin_permission < $admin->perm_read) {
            abort(403);
        }

        $students = User::where('is_student', true)->paginate(20);
        return view("admins.student_list", compact('students'));
    }
    protected function StudentWritePermission(Request $request)
    {
    }
    protected function HasWriteStudentPermission(Request $request)
    {
    }
    private function Permissions(Request $request)
    {
        $user = $request->user();
        if ($user->isAdmin->count() <= 0) {
            return 0;
        }
    }

    public function NewTeacherOrAdminAccount(Request $request)
    {

        $admin = $request->user()->isAdmin;
        if ($admin->admin_permission < $admin->perm_write) {
            abort(403);
        }

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'usertype' => ['required', 'integer', 'in:1,2'],
        ];

        $is_valid = $request->validate($rules);

        $password = Str::random(16);
        $new_user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'is_student' => false,
            'api_token' => Str::random(60),
            'profile_photo' => '/assets/images/user.png',
        ]);

        $resetToken = app('auth.password.broker')->createToken($new_user);

        $resetModel = PasswordResetModel::create([
            "email" => $new_user->email,
            "token" => $resetToken,
            "created_at" => Carbon::now(),
        ]);
        if ($request->usertype == 1) {
            $new_user->notify(new NewTeacherNotification($new_user, $resetToken));
        } else {
            $new_user->RegisterAsAdmin([
                "student_permission" => 0,
                "instructor_permission" => 0,
                "course_permission" => 0,
                "admin_permission" => 0,
                "blog_permission" => 0,
                "kb_permission" => 0, //knowledge base
                "settings_permission" => 0,
                "forum_permission" => 0,
                "quiz_permission" => 0,
            ]);
            $new_user->notify(new NewAdminNotification($new_user, $resetToken));
        }

        $account = $request->usertype == 1 ? " Teacher " : " Adminstrator ";
        return Redirect::back()->with('successmessage', 'successfully created new' . $account . " account ");
    }

    public function OpenInstructorsList(Request $request)
    {
        $instructors = InstructorModel::paginate(20);
        return view('instructor.inst_list', compact('instructors'));
    }
    public function AddUserToAdminGroup(Request $request)
    {

        $admin = $request->user()->isAdmin;
        if ($admin->admin_permission < $admin->perm_activate) {
            abort(403);
        }

        $rules = [
            "user_id" => ["required", "integer"],
        ];

        $is_valid = $request->validate($rules);

        $user = User::where('id', $request->user_id)->get();
        if ($user->count() < 1) {
            return Redirect::back()->withErrors(['user_id' => 'The given user cannot be added to admin group.']);
        }

        if ($user[0]->id == $request->user_id) {
            $user[0]->RegisterAsAdmin([
                "student_permission" => 0,
                "instructor_permission" => 0,
                "course_permission" => 0,
                "admin_permission" => 0,
                "blog_permission" => 0,
                "kb_permission" => 0, //knowledge base
                "settings_permission" => 0,
                "forum_permission" => 0,
                "quiz_permission" => 0,
            ]);

            return Redirect::back()->with('successmessage', 'Successfully added ' . $user[0]->name . ' to admin group');
        }

        return Redirect::back()->withErrors(['user_id' => 'The user you are tring to make an admin could not be verified ']);
    }

    public function ViewInstructorInfo(Request $request, $user_id)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->instructor_permission < $admin->perm_write) {
            abort(403);
        }

        $user = User::where('id', $user_id)->get();
        if ($user->count() <= 0) {
            abort(404);
        }

        $user = $user[0];
        $countries = CountryModel::all();
        return view('instructor.update_info', compact('user', 'countries'));
    }

    public function ViewStudentInfo(Request $request, $user_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->student_permission < $admin->perm_read, 403);

        $user = User::where('id', $user_id)->get();
        if ($user->count() <= 0) {
            abort(404);
        }

        $student = $user[0];
        $StudentInfo = $student->studentInfo;
        $countries = CountryModel::all();
        return view('student.student_info', compact('student', 'StudentInfo', 'countries'));
    }

    public function ViewCoursesPage(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_read, 403);

        return view('courses.main_page');
    }

    public function ViewStudentEnrolls(Request $request, $user_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->student_permission < $admin->perm_read, 403);

        $user = User::where('id', $user_id)->get();
        if ($user->count() <= 0) {
            abort(404);
        }

        $student = $user[0];

        $Enrollments = CourseEnrollsModel::where('student_id', $user_id)->with('courseInfo')->get();

        return view('student.student_enrolls', compact('Enrollments', 'student'));
    }

    public function AssignDiagnostic(Request $request, $user_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->student_permission < $admin->perm_read, 403);
        $student = User::where('id', $user_id)->get();
        if ($student->count() <= 0) {
            abort(404);
        }
        $rules = [
            "course" => "required|integer|exists:courses,id",
            "diagnostic" => "required|integer|exists:quizes,id",
            "lesson" => "nullable|integer"
        ];
        $data = $request->validate($rules);
        $course = CoursesModel::where('id', $request->course)->get();
        abort_if($course == null || $course->count() <= 0, 404);
        if (isset($data["lesson"]) && $request->lesson != "-1") {
            $lesson = LessonsModel::where('id', $request->lesson)->get();
            abort_if($lesson == null || $lesson->count() <= 0, 404);
        } else {
            $data["lesson"] = null;
        }
        $diagnostic = QuizesModel::where('id', $data["diagnostic"])->get();
        abort_if($diagnostic == null || $diagnostic->count() <= 0, 404);

        $DiagnosticModel = new StudentDiagnosticsModel();

        $new_diag = $DiagnosticModel->AssignDiagnostic($data, $student[0]->id, $admin->user_id);

        if (!$new_diag) {
            return Redirect::back()->withErrors(['error' => $DiagnosticModel->getError()]);
        }
        $student[0]->notify(new AssignedDiagnosticQuestionNotification($student[0]->studentInfo));
        return Redirect::back()->with('success', 'successfully assigned student to diagnostic');
    }

    public function ApproveCourseEnroll(Request $request, $user_id, $enroll_id)
    {
        $Enrollments = $this->ValidateEnrollRequestInfo($request, $enroll_id, $user_id);
        if (isset($Enrollments[0]) && isset($Enrollments[1])) {
            $student = $Enrollments[1];
            $Enrollments = $Enrollments[0];
        }
        abort_if(is_integer($Enrollments) && !$Enrollments instanceof CourseEnrollsModel, $Enrollments);
        if ($Enrollments[0]->enroll_status == 10 || $Enrollments[0]->enroll_status == 20) {
            $Enrollments[0]->update([
                "enroll_status" => 30
            ]);
            $student->notify(new RequestToEnrollCourseApproved($Enrollments[0]->courseInfo, $student));

            return Redirect::back()->with('success', 'successfully approved the enrollment for the student');
        }
        return Redirect::back()->withErrors(['enroll' => 'The enroll request is already approved']);
    }
    public function RejectCourseEnroll(Request $request, $user_id, $enroll_id)
    {

        $Enrollments = $this->ValidateEnrollRequestInfo($request, $enroll_id, $user_id);
        if (isset($Enrollments[0]) && isset($Enrollments[1])) {
            $student = $Enrollments[1];
            $Enrollments = $Enrollments[0];
        }
        abort_if(is_integer($Enrollments) && !$Enrollments instanceof CourseEnrollsModel, $Enrollments);
        if ($Enrollments[0]->enroll_status != 20) {
            $Enrollments[0]->update([
                "enroll_status" => 20
            ]);

            $student->notify(new RequestToEnrollCourseRejected($Enrollments[0]->courseInfo, $student));

            return Redirect::back()->with('success', 'successfully rejected the enrollment for the student');
        }
        return Redirect::back()->withErrors(['enroll' => 'The enroll request is already rejected']);
    }

    public function ValidateEnrollRequestInfo($request, $enroll_id, $user_id)
    {
        $admin = $request->user()->isAdmin;
        if ($admin->course_permission < $admin->perm_activate) return 403;

        $user = User::where('id', $user_id)->get();
        if ($user->count() <= 0) {
            return 404;
        }

        $student = $user[0];

        $Enrollments = CourseEnrollsModel::where('id', $enroll_id)->with('courseInfo')->get();
        abort_if(is_integer($Enrollments) && !$Enrollments instanceof CourseEnrollsModel, $Enrollments);
        if ($Enrollments == null || $Enrollments->count() <= 0) return 404;

        return [$Enrollments, $student];
    }

    public function OpenQuizesList(Request $request, $user_id)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->student_permission < $admin->perm_read, 403);

        $student = User::where('id', $user_id)->get();
        if ($student->count() <= 0) {
            abort(404);
        }

        $quizes = $student[0]->Diagnostics;
        $Courses = CoursesModel::get();
        $Diagnostics = QuizesModel::where('is_diagnostic', true)->get();
        return view('quiz.student_quiz', compact('quizes', 'Diagnostics', 'Courses'));
    }
}
