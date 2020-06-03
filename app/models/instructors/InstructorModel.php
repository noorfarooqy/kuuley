<?php

namespace App\models\instructors;

use App\User;
use Illuminate\Database\Eloquent\Model;

class InstructorModel extends Model
{
    //
    protected $table = "instructor_info";
    protected $fillable = [
        "instructor_id",
        "inst_firstname",
        "inst_secondname",
        "inst_lastname",
        "inst_biography",
        "inst_living_country",
        "inst_living_city",
        "inst_living_address",
        "inst_nationality",
        "inst_telephone",
        "inst_telephone_two",
        "inst_is_female",
        "inst_specialization",
        "inst_is_active",
        "inst_fb",
        "inst_twitter",
        "inst_linkedin",
        "inst_github",
        "inst_youtube",
    ];

    public function updateBasic($data)
    {
        $updatedInfo = $this->update([
            "inst_firstname" => $data['first_name'],
            "inst_secondname" => $data['second_name'],
            "inst_lastname" => $data['last_name'],
            "inst_biography" => $data['biography'],
            "inst_nationality" => $data['nationality'],
            "inst_is_female" => $data['gender'] == 1,
            "inst_specialization" => $data['profession'],
        ]);
        return $updatedInfo;
    }
    public function updateAddressInfo($data)
    {
        $updatedInfo = $this->update([
            "inst_living_country" => $data['living_country'],
            "inst_living_city" => $data['living_city'],
            "inst_living_address" => $data['living_address'],
            "inst_telephone" => $data['telephone'],
            "inst_telephone_two" => $data['telephone_two'],
        ]);
        return $updatedInfo;
    }

    public function updateSocialInfo($data)
    {
        $updatedInfo = $this->update([
            "inst_fb" => $data['facebook'],
            "inst_twitter" => $data['twitter'],
            "inst_youtube" => $data['youtube'],
            "inst_github" => $data['github'],
            "inst_linkedin" => $data['linkedin'],
        ]);
        return $updatedInfo;
    }

    public function storeInfo($data, $inst_id)
    {
        $this->create([
            "instructor_id" => $inst_id,
            "inst_firstname" => $data['first_name'],
            "inst_secondname" => $data['second_name'],
            "inst_lastname" => $data['last_name'],
            "inst_biography" => $data['biography'],
            "inst_nationality" => $data['nationality'],
            "inst_is_female" => $data['gender'] == 1,
            "inst_specialization" => $data['profession'],
        ]);
    }
    public function UserInfo()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }
}
