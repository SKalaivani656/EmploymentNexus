<?php

use App\Http\Controllers\Website\Api\Blog\BlogwebapiController;
use App\Http\Controllers\Website\Api\Employee\EmployeewebapiController;
use App\Http\Controllers\Website\Api\Job\JobwebapiController;
use App\Http\Controllers\Website\Api\Video\VideowebapiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'employee', 'middleware' => 'api'], function () {
    Route::post('/devicetoken', [EmployeewebapiController::class, 'devicetoken']);
    Route::post('/subscribe', [EmployeewebapiController::class, 'subscribe']);
});

Route::group(['prefix' => 'job', 'middleware' => 'api'], function () {
    Route::get('/joblist', [JobwebapiController::class, 'joblist']);
    Route::post('/getjobbyid', [JobwebapiController::class, 'getjobbyid']);
    Route::post('/getjobtypelist', [JobwebapiController::class, 'getjobtypelist']);
    Route::post('/jobclassification', [JobwebapiController::class, 'jobclassification']);
    Route::post('/getjobclassificationbyid', [JobwebapiController::class, 'getjobclassificationbyid']);
    Route::post('/jobsearch', [JobwebapiController::class, 'jobsearch']);
    Route::get('/jobfilter', [JobwebapiController::class, 'jobfilter']);
    Route::post('/pushnotification', [JobwebapiController::class, 'pushnotification']);

});

Route::group(['prefix' => 'blog', 'middleware' => 'api'], function () {
    Route::get('/bloglist', [BlogwebapiController::class, 'bloglist']);
    Route::post('/getblogbyid', [BlogwebapiController::class, 'getblogbyid']);
    Route::post('/blogclassification', [BlogwebapiController::class, 'blogclassification']);
    Route::post('/getblogclassificationbyid', [BlogwebapiController::class, 'getblogclassificationbyid']);
    Route::post('/blogfilter', [BlogwebapiController::class, 'blogfilter']);
});

Route::group(['prefix' => 'video', 'middleware' => 'api'], function () {
    Route::get('/videolist', [VideowebapiController::class, 'videolist']);
    Route::post('/getvideobyid', [VideowebapiController::class, 'getvideobyid']);
    Route::post('/videoclassification', [VideowebapiController::class, 'videoclassification']);
    Route::post('/getvideoclassificationbyid', [VideowebapiController::class, 'getvideoclassificationbyid']);
    Route::post('/videofilter', [VideowebapiController::class, 'videofilter']);
});
