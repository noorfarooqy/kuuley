<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\instructors\InstructorModel;
use App\models\misc\CountryModel;
use App\models\misc\PasswordResetModel;
use App\Notifications\admin\NewAdminNotification;
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

        $user = $user[0];
        $countries = CountryModel::all();
        return view('student.student_info', compact('user', 'countries'));
    }

    public function ViewCoursesPage(Request $request)
    {
        $admin = $request->user()->isAdmin;
        abort_if($admin->course_permission < $admin->perm_read, 403);

        return view('courses.main_page');
    }


}
