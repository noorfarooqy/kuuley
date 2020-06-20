<?php

namespace App\models\students;

use Illuminate\Database\Eloquent\Model;

class StudentInfoModel extends Model
{
    //
    protected $table = "students_info";
    protected $fillable = [
        "student_id",
        "student_firstname",
        "student_secondname",
        "student_lastname",
        "student_biography",
        "student_living_country",
        "student_living_city",
        "student_living_address",
        "student_nationality",
        "student_telephone",
        "student_telephone_two",
        "student_is_female",
        "student_specialization",
        "student_is_active",
        "student_fb",
        "student_twitter",
        "student_linkedin",
        "student_github",
        "student_youtube",
    ];

    public function updateBasic($data)
    {
        $updatedInfo = $this->update([
            "student_firstname" => $data['first_name'],
            "student_secondname" => $data['second_name'],
            "student_lastname" => $data['last_name'],
            "student_biography" => $data['biography'],
            "student_nationality" => $data['nationality'],
            "student_is_female" => $data['gender'] == 1,
            "student_specialization" => $data['profession'],
        ]);
        return $updatedInfo;
    }
    public function updateAddressInfo($data)
    {
        $updatedInfo = $this->update([
            "student_living_country" => $data['living_country'],
            "student_living_city" => $data['living_city'],
            "student_living_address" => $data['living_address'],
            "student_telephone" => $data['telephone'],
            "student_telephone_two" => $data['telephone_two'],
        ]);
        return $updatedInfo;
    }

    public function updateSocialInfo($data)
    {
        $updatedInfo = $this->update([
            "student_fb" => $data['facebook'],
            "student_twitter" => $data['twitter'],
            "student_youtube" => $data['youtube'],
            "student_github" => $data['github'],
            "student_linkedin" => $data['linkedin'],
        ]);
        return $updatedInfo;
    }

    public function storeInfo($data, $student_id)
    {
        $this->create([
            "student_id" => $student_id,
            "student_firstname" => $data['first_name'],
            "student_secondname" => $data['second_name'],
            "student_lastname" => $data['last_name'],
            "student_biography" => $data['biography'],
            "student_nationality" => $data['nationality'],
            "student_is_female" => $data['gender'] == 1,
            "student_specialization" => $data['profession'],
        ]);
    }
    public function UserInfo()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }
}
