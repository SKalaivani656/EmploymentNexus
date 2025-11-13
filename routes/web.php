<?php

use App\Http\Controllers\Website\Web\Blog\BlogController;
use App\Http\Controllers\Website\Web\Job\WebjobController;
use App\Http\Controllers\Website\Web\Mobileapp\MobileappController;
use App\Http\Controllers\Website\Web\Video\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebjobController::class, 'index'])->name('jobindex');
Route::get('/jobs/{postjob:slug}', [WebjobController::class, 'show'])->name('jobdescription');
Route::get('/jobs/{type}/{slug}', [WebjobController::class, 'jobtype'])->name('jobtype');
Route::get('/jobs-list/{list}', [WebjobController::class, 'listdata'])->name('listdata');

Route::get('/jobs-blog', [BlogController::class, 'blog']);
Route::get('/jobs-blog/category', [BlogController::class, 'categorybloglist']);
Route::get('/jobs-blog/tag', [BlogController::class, 'tagbloglist']);
Route::get('/jobs-blog/{slug}', [BlogController::class, 'blogdescription']);
Route::get('/jobs-blog/category/{slug}', [BlogController::class, 'category'])->name('categoryblog');
Route::get('/jobs-blog/tag/{slug}', [BlogController::class, 'tag'])->name('tagblog');

Route::get('/jobs-video', [VideoController::class, 'video']);
Route::get('/jobs-video/category', [VideoController::class, 'categoryvideolist']);
Route::get('/jobs-video/tag', [VideoController::class, 'tagvideolist']);
Route::get('/jobs-video/{slug}', [VideoController::class, 'article']);
Route::get('/jobs-video/category/{slug}', [VideoController::class, 'category'])->name('categoryvideo');
Route::get('/jobs-video/tag/{slug}', [VideoController::class, 'tag'])->name('tagvideo');

Route::view('/about-us', 'website/aboutus/aboutus');

Route::get('/jobdescription/{uuid}', [MobileappController::class, 'jobdescription'])->name('jobdescriptionmobile');
Route::get('/blogdescription/{uuid}', [MobileappController::class, 'blogdescription'])->name('blogdescriptionmobile');
