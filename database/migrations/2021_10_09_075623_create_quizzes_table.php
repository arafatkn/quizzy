<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id')->index();
            $table->string('name');
            $table->unsignedInteger('time_limit');
            $table->boolean('author_digest');
            $table->boolean('status');
            $table->unsignedInteger('total_questions');
            // User can add unlimited questions but only the mentioned number of questions will be shown randomly
            // to the examinees.
            $table->unsignedInteger('total_marks');
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
        Schema::dropIfExists('quizzes');
    }
}
