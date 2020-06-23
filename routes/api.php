<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::post('/courses/list/instructor', 'courses\CourseController@GetInstructorCourseList');
        Route::post('courses/quizes', 'quiz\QuizController@GetQuizAssignments');
        Route::post('/quiz/new', 'quiz\QuizController@NewQuestion');
        Route::post('/quiz/questions', 'quiz\QuizController@GetQuizQuestions');
        Route::post('/quiz/questions/delete', 'quiz\QuizController@DeteleQuestion');
    });
    Route::prefix('/student')->group(function () {
        Route::post('/courses', 'students\StudentController@GetCoursesListApi');
        Route::post('/courses/info', 'courses\CourseController@getCourseInfo');
        Route::post('/courses/enroll', 'courses\CourseController@EnrollRequest');
    });
});
