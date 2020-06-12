<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizes', function (Blueprint $table) {
            $table->id();
            $table->string('quiz_title');
            $table->string('quiz_instructions',1200);
            $table->boolean('has_course')->default(false);
            $table->unsignedBigInteger('course_id')->nullable();
            $table->boolean('is_diagnostic');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->unsignedInteger('created_by');
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
        Schema::dropIfExists('quizes');
    }
}
