<?php

namespace App\models\misc;

use Illuminate\Database\Eloquent\Model;

class UploadedFilesModel extends Model
{
    //
    protected $table = "uploaded_files";
    protected $fillable = [
        "file_url",
        "file_type",
        "uploaded_by",
    ];
}
