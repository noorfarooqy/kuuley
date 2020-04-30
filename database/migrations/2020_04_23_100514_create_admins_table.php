<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('student_permission');
            $table->unsignedSmallInteger('instructor_permission');
            $table->unsignedSmallInteger('course_permission');
            $table->unsignedSmallInteger('admin_permission');
            $table->unsignedSmallInteger('blog_permission');
            $table->unsignedSmallInteger('kb_permission'); //knowledge base
            $table->unsignedSmallInteger('settings_permission'); //application settings
            $table->unsignedSmallInteger('forum_permission');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
