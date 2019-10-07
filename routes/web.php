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

//#### Frontend Routes ######//
//frontend index page
Route::get('/', function () { return view('frontend.welcome');});

//display questions by category
Route::get('test/dmv/{categoryId}', ["uses"=>"QuestionsController@showQuestionsByCategory", "as"=> "dispalyTest"]);
Route::get('test/dmv', ["uses"=>"QuestionsController@listTests", "as"=> "listDMVTests"]);

//display events list
Route::get('/events', ["uses"=>"EventsController@listEvents", "as"=> "listEvents"]);




//auth routs
Auth::routes();
Route::get('/dashboard', 'DashboardController@index');

//#### Admin Panel Routes ######//

//display all questions
Route::get('admin/questions', ["uses"=>"Admin\AdminQuestionsController@index", "as"=> "adminDisplayQuestions"]);
//display create question form
Route::get('admin/question/create', ["uses"=>"Admin\AdminQuestionsController@create", "as"=> "adminCreateQuestion"]);
//display insert question
Route::post('admin/question/insert', ["uses"=>"Admin\AdminQuestionsController@insert", "as"=> "adminInsertQuestion"]);
//display edit question form
Route::get('admin/question/edit/{id}', ["uses"=>"Admin\AdminQuestionsController@edit", "as"=> "adminEditQuestion"]);
//update question form data
Route::post('admin/question/update/{id}', ["uses"=>"Admin\AdminQuestionsController@update", "as"=> "adminUpdateQuestion"]);
//delete question
Route::get('admin/question/delete/{id}', ["uses"=>"Admin\AdminQuestionsController@delete", "as"=> "adminDeleteQuestion"]);

//Add Question Option 
Route::post('admin/question/option/add/{questionId}', ["uses"=>"Admin\AdminQuestionOptionsController@add", "as"=> "adminAddQuestionOption"]);
//Delete Question Option
Route::get('admin/question/option/delete/{questionId}/{optionId}', ["uses"=>"Admin\AdminQuestionOptionsController@delete", "as"=> "adminDeleteQuestionOption"]);

//display all categories
Route::get('admin/categories', ["uses"=>"Admin\AdminCategoriesController@index", "as"=> "adminDisplayCategories"]);
//display create category form
Route::get('admin/category/create', ["uses"=>"Admin\AdminCategoriesController@create", "as"=> "adminCreateCategory"]);
//insert new category
Route::post('admin/category/insert', ["uses"=>"Admin\AdminCategoriesController@insert", "as"=> "adminInsertCategory"]);
//edit category form
Route::get('admin/category/edit/{id}', ["uses"=>"Admin\AdminCategoriesController@edit", "as"=> "adminEditCategory"]);
//update category
Route::post('admin/category/update/{id}', ["uses"=>"Admin\AdminCategoriesController@update", "as"=> "adminUpdateCategory"]);
//delete question
Route::get('admin/category/delete/{id}', ["uses"=>"Admin\AdminCategoriesController@delete", "as"=> "adminDeleteCategory"]);

//dispaly Events
Route::get('admin/events', ["uses"=>"Admin\AdminEventsController@index", "as"=> "adminDisplayEvents"]);
//display create event form
Route::get('admin/event/create', ["uses"=>"Admin\AdminEventsController@create", "as"=> "adminCreateEvent"]);
//insert new event
Route::post('admin/event/insert', ["uses"=>"Admin\AdminEventsController@insert", "as"=> "adminInsertEvent"]);
//edit event form
Route::get('admin/event/edit/{id}', ["uses"=>"Admin\AdminEventsController@edit", "as"=> "adminEditEvent"]);
//update category
Route::post('admin/event/update/{id}', ["uses"=>"Admin\AdminEventsController@update", "as"=> "adminUpdateEvent"]);
//delete question
Route::get('admin/event/delete/{id}', ["uses"=>"Admin\AdminEventsController@delete", "as"=> "adminDeleteEvent"]);

//dispaly Services
Route::get('admin/services', ["uses"=>"Admin\AdminServicesController@index", "as"=> "adminDisplayServices"]);
//display create event form
Route::get('admin/service/create', ["uses"=>"Admin\AdminServicesController@create", "as"=> "adminCreateService"]);
//insert new event
Route::post('admin/service/insert', ["uses"=>"Admin\AdminServicesController@insert", "as"=> "adminInsertService"]);
//edit event form
Route::get('admin/service/edit/{id}', ["uses"=>"Admin\AdminServicesController@edit", "as"=> "adminEditService"]);
//update category
Route::post('admin/service/update/{id}', ["uses"=>"Admin\AdminServicesController@update", "as"=> "adminUpdateService"]);
//delete question
Route::get('admin/service/delete/{id}', ["uses"=>"Admin\AdminServicesController@delete", "as"=> "adminDeleteService"]);

//dispaly Jobs
Route::get('admin/jobs', ["uses"=>"Admin\AdminJobsController@index", "as"=> "adminDisplayJobs"]);
//display create event form
Route::get('admin/job/create', ["uses"=>"Admin\AdminJobsController@create", "as"=> "adminCreateJob"]);
//insert new event
Route::post('admin/job/insert', ["uses"=>"Admin\AdminJobsController@insert", "as"=> "adminInsertJob"]);
//edit event form
Route::get('admin/job/edit/{id}', ["uses"=>"Admin\AdminJobsController@edit", "as"=> "adminEditJob"]);
//update category
Route::post('admin/job/update/{id}', ["uses"=>"Admin\AdminJobsController@update", "as"=> "adminUpdateJob"]);
//delete question
Route::get('admin/job/delete/{id}', ["uses"=>"Admin\AdminJobsController@delete", "as"=> "adminDeleteJob"]);
