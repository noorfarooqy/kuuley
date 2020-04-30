<?php

namespace App\models\misc;

use Illuminate\Database\Eloquent\Model;

class PasswordResetModel extends Model
{
    //
    protected $table = 'password_resets';

    protected $fillable = [
        "email",
        "token",
        "created_at",
    ];

    public $timestamps = false;
}
