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
            $table->string('inst_living_country');
            $table->string('inst_living_city');
            $table->string('inst_living_address');
            $table->string('inst_nationality');
            $table->string('inst_telephone');
            $table->string('inst_telephone_two')->nullable();
            $table->boolean('inst_is_female')->default(true);
            $table->string('inst_specialization');
            $table->boolean('inst_is_active')->default(false);
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
