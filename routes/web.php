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

    Route::middleware(['admin_auth'])->group(function () {
        Route::prefix('/admin')->group(function(){
            Route::get('/', 'admin\AdminController@openDashBoard');
            Route::get('/dashboard', 'admin\AdminController@openDashBoard');
            Route::get('/users', 'admin\AdminController@openUsersList');
            Route::prefix('/accounts')->group(function(){
                Route::post('/new', 'admin\AdminController@NewTeacherOrAdminAccount')->name('create-teacher-admin');
                Route::post('/new/admin', 'admin\AdminController@AddUserToAdminGroup')->name('make-user-admin');
                Route::prefix('/inst')->group(function(){
                    Route::get('/{user_id}', 'admin\AdminController@ViewInstructorInfo');
                    Route::post('/update/{inst_id}', 'instructor\InstructorController@UpdateBasicInfo');
                    Route::post('/update/address/{inst_id}', 'instructor\InstructorController@UpdateAddressInfo');
                    Route::post('/update/social/{inst_id}', 'instructor\InstructorController@UpdateSocialInfo');
                });
                
            });
            Route::get('/instructors', 'admin\AdminController@OpenInstructorsList');
        });
    });


});
Route::get('/home', 'HomeController@index')->name('home');
