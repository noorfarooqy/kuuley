<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;
use App\models\instructors\InstructorModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InstructorController extends Controller
{
    //
    public function UpdateBasicInfo(Request $request, $instructor_id)
    {
        $Instructor = User::where([
            ['id', $instructor_id],
            ['is_student', false]
        ])->get();
        if ($Instructor->count() <= 0)
            abort(404);
        $user = $request->user();
        if ($user->id != $instructor_id) {
            $admin_permissions = $user->isAdmin;
            if ($admin_permissions == null)
                abort(404);;
            if ($admin_permissions->instructor_permission < $admin_permissions->perm_edit)
                abort(403);
        }
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

        $InstructorModel = new InstructorModel();
        if ($Instructor[0]->HasInstructorInfo()) {
            $InstructorInfo =  $Instructor[0]->InstructorInfo;
            $InstructorInfo = $InstructorInfo->updateBasic($data);
        } else
            $InstructorInfo = $InstructorModel->storeInfo($data, $instructor_id);

        return Redirect::back()->with('success', 'Successfully updated basic information');
    }


    public function UpdateAddressInfo(Request $request, $instructor_id)
    {
        $Instructor = User::where([
            ['id', $instructor_id],
            ['is_student', false]
        ])->get();
        if ($Instructor->count() <= 0)
            abort(404);
        $user = $request->user();
        if ($user->id != $instructor_id) {
            $admin_permissions = $user->isAdmin;
            if ($admin_permissions == null)
                abort(404);;
            if ($admin_permissions->instructor_permission < $admin_permissions->perm_edit)
                abort(403);
        }
        $rules = [
            "living_country" => "required|integer|between:1,246",
            "living_city" => "required|string|max:255|min:2",
            "living_address" => "required|string|max:255|min:2",
            "telephone" => "required|string|max:255|min:8",
            "telephone_two" => "nullable|string|max:255|min:8",
        ];

        $data = $request->validate($rules);

        $InstructorModel = new InstructorModel();
        if ($Instructor[0]->HasInstructorInfo()) {
            $InstructorInfo =  $Instructor[0]->InstructorInfo;
            $InstructorInfo = $InstructorInfo->updateAddressInfo($data);
        } else
            $InstructorInfo = $InstructorModel->storeInfo($data, $instructor_id);

        return Redirect::back()->with('success', 'Successfully updated address information');
    }
    public function UpdateSocialInfo(Request $request, $instructor_id)
    {
        $Instructor = User::where([
            ['id', $instructor_id],
            ['is_student', false]
        ])->get();
        if ($Instructor->count() <= 0)
            abort(404);
        $user = $request->user();
        if ($user->id != $instructor_id) {
            $admin_permissions = $user->isAdmin;
            if ($admin_permissions == null)
                abort(404);;
            if ($admin_permissions->instructor_permission < $admin_permissions->perm_edit)
                abort(403);
        }
        $rules = [
            "facebook" => "nullable|url|max:255|min:10|",
            "youtube" => "nullable|url|max:255|min:10",
            "twitter" => "nullable|url|max:255|min:10",
            "github" => "nullable|url|max:255|min:10",
            "linkedin" => "nullable|url|max:255|min:10",
        ];

        $data = $request->validate($rules);

        $InstructorModel = new InstructorModel();
        if ($Instructor[0]->HasInstructorInfo()) {
            $InstructorInfo =  $Instructor[0]->InstructorInfo;
            $InstructorInfo = $InstructorInfo->updateSocialInfo($data);
        } else
            $InstructorInfo = $InstructorModel->storeInfo($data, $instructor_id);

        return Redirect::back()->with('success', 'Successfully updated social information');
    }
}
