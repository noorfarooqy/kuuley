<?php

namespace App\Http\Controllers\quiz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //
    public function ViewQuizIndexPage(Request $request)
    {
        $admin = $request->user()->AdminInfo;

        return view('quiz.quiz_index');
    }
}
