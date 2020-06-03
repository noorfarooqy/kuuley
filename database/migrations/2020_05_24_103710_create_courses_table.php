<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name',75);
            $table->string('course_description',1200);
            $table->unsignedBigInteger('course_category');
            $table->boolean('course_is_active')->default(false);
            $table->unsignedBigInteger('course_created_by');
            $table->string('course_preview_image',425)->default('/assets/images/course_preview.jpg');
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
        Schema::dropIfExists('courses');
    }
}
