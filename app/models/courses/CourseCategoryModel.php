<?php

namespace App\models\courses;

use Illuminate\Database\Eloquent\Model;

class CourseCategoryModel extends Model
{
    //
    protected $table = "course_category";
    protected $fillable = [
        "category_name",
        "is_active",
        "created_by"
    ];

    public function AddCategory($data, $creator)
    {
        return $this->create([
            "category_name" => $data["categoryName"],
            "is_active" => true,
            "created_by" => $creator
        ]);
    }
}
