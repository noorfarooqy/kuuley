<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('student_firstname');
            $table->string('student_secondname');
            $table->string('student_lastname');
            $table->string('student_biography', 1200)->nullable();
            $table->string('student_living_country')->nullable();
            $table->string('student_living_city')->nullable();
            $table->string('student_living_address')->nullable();
            $table->string('student_nationality')->nullable();
            $table->string('student_telephone')->nullable();
            $table->string('student_telephone_two')->nullable();
            $table->boolean('student_is_female')->default(true);
            $table->string('student_specialization')->nullable();
            $table->boolean('student_is_active')->default(false);
            $table->string('student_fb')->nullable();
            $table->string('student_twitter')->nullable();
            $table->string('student_linkedin')->nullable();
            $table->string('student_github')->nullable();
            $table->string('student_youtube')->nullable();
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
        Schema::dropIfExists('students_info');
    }
}
