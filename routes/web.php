<?php

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth:admin,web');

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('student/{id}','StudentsController@show')->name('student.show')->middleware('auth:admin,web');
route::get('course/{id}','coursesController@show')->name('course.show')->middleware('auth:admin,web');


Route::group(['prefix' => 'admin','middleware'=>'auth:admin'], function () {

    Route::get('/','AdminsController@index')->name('admin.index');
    Route::get('students','StudentsController@index')->name('student.index');
    Route::put('student/{id}','StudentsController@update')->name('student.update');

    Route::get('students/create','AdminsController@create_student')->name('student.create');


});


Route::group(['middleware'=>'auth:web'],function(){
    Route::get('courses','CoursesController@index')->name('courses.index');
    Route::post('courses','CoursesController@store')->name('courses.store');
    Route::delete('courses/{id}','CoursesController@destroy')->name('courses.destroy');


});

Route::group(['prefix' => 'course','middleware'=>'auth:admin'], function () {
    route::put('{id}','coursesController@update')->name('course.update');
});


Route::get('/register','StudentsController@create')->name('register');
Route::post('/register','StudentsController@store')->name('student.store');
