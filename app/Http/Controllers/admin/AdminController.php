<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\misc\PasswordResetModel;
use App\Notifications\admin\NewAdminNotification;
use App\Notifications\teachers\NewTeacherNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    //
    protected $student_permission;
    protected $instructor_permission;

    protected $perm_none = 0; //no permission
    protected $perm_read = 10; // permission to read resources
    protected $perm_write = 20; //permission to write/create resource
    protected $perm_edit = 30; //permission to edit resources
    protected $perm_delete = 40; //permission to delete resources
    protected $perm_diactivate = 50; //permission to deactivate resources
    protected $perm_activate = 60; //permission to activate resources

    public function __construct()
    {

    }

    public function openDashBoard(Request $request)
    {
        return view("admins.dashboard");
    }

    public function openUsersList(Request $request)
    {
        $users = User::where([
            ["is_student", false],
            ["id", "!=", $request->user()->id],
        ])->get();
        return view("admins.userslist", compact('users'));
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
        
        $rules =  [
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
        if($request->usertype == 1)
        {
            $new_user->notify(new NewTeacherNotification($new_user, $resetToken));
        }
        else
        {
            $new_user->RegisterAsAdmin([
                "student_permission" => 0,
                "instructor_permission" => 0,
                "course_permission" => 0,
                "admin_permission" => 0,
                "blog_permission" => 0,
                "kb_permission" => 0, //knowledge base
                "settings_permission" => 0,
                "forum_permission" => 0,
            ]);
            $new_user->notify(new NewAdminNotification($new_user, $resetToken));
        }    
        
        $account = $request->usertype == 1 ? " Teacher " : " Adminstrator ";
        return Redirect::back()->with('successmessage', 'successfully created new'.$account." account ");
    }

    public function OpenInstructorsList(Request $request)
    {
        // $instructors =
    }
    public function AddUserToAdminGroup(Request $request)
    {
        $rules = [
            "user_id" => ["required", "integer"]
        ];

        $is_valid = $request->validate($rules);

        $user = User::where('id', $request->user_id)->get();
        if($user->count() < 1)
            return Redirect::back()->withErrors(['user_id'=> 'The given user cannot be added to admin group.']);
        if($user[0]->id == $request->user_id)
        {
            $user[0]->RegisterAsAdmin([
                "student_permission" => 0,
                "instructor_permission" => 0,
                "course_permission" => 0,
                "admin_permission" => 0,
                "blog_permission" => 0,
                "kb_permission" => 0, //knowledge base
                "settings_permission" => 0,
                "forum_permission" => 0,
            ]);

            return Redirect::back()->with('successmessage', 'Successfully added '.$user[0]->name.' to admin group');
        }

        return Redirect::back()->withErrors(['user_id'=> 'The user you are tring to make an admin could not be verified ']);
    }
}
