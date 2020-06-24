<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();
Route::get('/', function () {
    return view('index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'HomeController@openDashboard');
    Route::post('/upload/save', 'misc\UploadedFilesController@UploadNewFile');
    Route::post('/upload/remove', 'misc\UploadedFilesController@RemoveFile');
    Route::middleware(['admin_auth'])->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::get('/', 'admin\AdminController@openDashBoard');
            Route::get('/dashboard', 'admin\AdminController@openDashBoard');
            Route::get('/users', 'admin\AdminController@openUsersList');
            Route::prefix('/accounts')->group(function () {
                Route::post('/new', 'admin\AdminController@NewTeacherOrAdminAccount')->name('create-teacher-admin');
                Route::post('/new/admin', 'admin\AdminController@AddUserToAdminGroup')->name('make-user-admin');
                Route::prefix('/inst')->group(function () {
                    Route::get('/{user_id}', 'admin\AdminController@ViewInstructorInfo');
                    Route::post('/update/{inst_id}', 'instructor\InstructorController@UpdateBasicInfo');
                    Route::post('/update/address/{inst_id}', 'instructor\InstructorController@UpdateAddressInfo');
                    Route::post('/update/social/{inst_id}', 'instructor\InstructorController@UpdateSocialInfo');
                });
            });
            Route::prefix('/student')->group(function () {
                Route::get('/list', 'admin\AdminController@ViewStudentsList');
                Route::get('/{student_id}', 'admin\AdminController@ViewStudentInfo');
                Route::get('/{student_id}/enrolls', 'admin\AdminController@ViewStudentEnrolls');
                Route::get('/{student_id}/enrolls/{enroll_id}/approve', 'admin\AdminController@ApproveCourseEnroll');
                Route::get('/{student_id}/enrolls/{enroll_id}/reject', 'admin\AdminController@RejectCourseEnroll');
            });
            Route::prefix('/cat')->group(function () {
                Route::post('/new', 'courses\CourseController@NewCourseCategory');
                Route::get('/{student_id}', 'admin\AdminController@ViewStudentInfo');
            });
            Route::prefix('/quiz')->group(function () {
                Route::get('/', 'quiz\QuizController@ViewQuizIndexPage');
                Route::post('/', 'quiz\QuizController@CreateQuiz');
                Route::get('/{quiz_id}', 'quiz\QuizController@ViewGivenQuiz');
            });
            Route::prefix('/courses')->group(function () {
                Route::get('/', 'admin\AdminController@ViewCoursesPage');
                Route::get('/new', 'courses\CourseController@AddNewCoursePage');
                Route::post('/new', 'courses\CourseController@AddNewCourse');
                Route::get('/list', 'courses\CourseController@ViewCoursesList');
                Route::get('/list/inactive', 'courses\CourseController@ViewInactiveCourses');
                Route::get('/{course_id}', 'courses\CourseController@ViewCoursesGiven');
                Route::post('/{course_id}/update', 'courses\CourseController@UpdateCoursesGiven');
                Route::get('/{course_id}/lessons', 'courses\LessonsController@OpenLessonsPage');
                Route::get('/{course_id}/lessons/list', 'courses\CourseController@ViewCourseLessons');
                Route::get('/{course_id}/lessons/{lesson_id}', 'courses\LessonsController@ViewLessonInfo');
                Route::post('/{course_id}/lessons/{lesson_id}/update', 'courses\LessonsController@UpdateLesson');
                Route::post('/{course_id}/lessons', 'courses\LessonsController@AddNewLession');
                Route::post('/{course_id}/lessons/section', 'courses\LessonsController@AddNewSection');
            });
            Route::get('/instructors', 'admin\AdminController@OpenInstructorsList');
        });
    });
    Route::middleware(['verified'])->group(function () {
        Route::prefix('/student')->group(function () {
            Route::get('/profile', 'students\StudentController@OpenStudentProfile')->name('studentProfile');
            Route::post('/profile/update', 'students\StudentController@UpdateBasicInfo');
            Route::post('/profile/update/address', 'students\StudentController@UpdateAddressInfo');
            Route::post('/profile/update/socials', 'students\StudentController@UpdateSocialInfo');
            Route::get('/courses/lessons', 'students\StudentController@OpenCourseLessons');
            Route::get('/courses/{course_id}/lessons/list', 'courses\CourseController@ViewCourseLessons');
            Route::get('/courses', 'students\StudentController@GetCoursesList');
            Route::get('/courses/{course_id}', 'students\StudentController@GetCourseInfoPage');
            Route::get('/courses/{course_id}/lessons/{lesson_id}', 'students\StudentController@GetLessonEnrolled');
        });
    });
});
Route::get('/home', 'HomeController@index')->name('home');
