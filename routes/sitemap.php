<?php

use App\Http\Controllers\Website\Web\Seo\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/sitemap.xml/jobs', [SitemapController::class, 'jobs']);
Route::get('/sitemap.xml/jobs-categories', [SitemapController::class, 'jobscategories']);
Route::get('/sitemap.xml/jobs-tags', [SitemapController::class, 'jobstags']);

Route::get('/sitemap.xml/jobs-branches', [SitemapController::class, 'jobbranches']);
Route::get('/sitemap.xml/jobs-companies', [SitemapController::class, 'jobcompanies']);
Route::get('/sitemap.xml/jobs-courses', [SitemapController::class, 'jobcourses']);
Route::get('/sitemap.xml/jobs-designation', [SitemapController::class, 'jobdesignation']);
Route::get('/sitemap.xml/jobs-languages', [SitemapController::class, 'joblanguages']);
Route::get('/sitemap.xml/jobs-roles', [SitemapController::class, 'jobroles']);
Route::get('/sitemap.xml/jobs-skills', [SitemapController::class, 'jobsills']);
Route::get('/sitemap.xml/jobs-types', [SitemapController::class, 'jobtypes']);
Route::get('/sitemap.xml/jobs-competitiveexams', [SitemapController::class, 'jobcompetitiveexams']);

Route::get('/sitemap.xml/jobs-blogs', [SitemapController::class, 'blogs']);
Route::get('/sitemap.xml/jobs-blogs-categories', [SitemapController::class, 'blogscategories']);
Route::get('/sitemap.xml/jobs-blogs-tags', [SitemapController::class, 'blogstags']);

Route::get('/sitemap.xml/jobs-videos', [SitemapController::class, 'videos']);
Route::get('/sitemap.xml/jobs-videos-categories', [SitemapController::class, 'videoscategories']);
Route::get('/sitemap.xml/jobs-videos-tags', [SitemapController::class, 'videostags']);
