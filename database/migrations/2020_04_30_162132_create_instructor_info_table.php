<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_id');
            $table->string('inst_firstname');
            $table->string('inst_secondname');
            $table->string('inst_lastname');
            $table->string('inst_biography',1200)->nullable();
            $table->string('inst_living_country')->nullable();
            $table->string('inst_living_city')->nullable();
            $table->string('inst_living_address')->nullable();
            $table->string('inst_nationality')->nullable();
            $table->string('inst_telephone')->nullable();
            $table->string('inst_telephone_two')->nullable();
            $table->boolean('inst_is_female')->default(true);
            $table->string('inst_specialization')->nullable();
            $table->boolean('inst_is_active')->default(false);
            $table->string('inst_fb')->nullable();
            $table->string('inst_twitter')->nullable();
            $table->string('inst_linkedin')->nullable();
            $table->string('inst_github')->nullable();
            $table->string('inst_youtube')->nullable();
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
        Schema::dropIfExists('instructor_info');
    }
}
