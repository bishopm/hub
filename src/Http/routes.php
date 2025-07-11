<?php

use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

// Churches routes
Route::domain('churches.' . env('APP_URL'))->group(function() {
    Route::middleware(['web'])->controller('\Bishopm\Hub\Http\Controllers\HomeController')->group(function () {
        Route::get('/', 'churcheshome')->name('churches.home');
        Route::get('/churches', 'churches')->name('churches.churches');
        Route::get('/churches/{slug}', 'church')->name('churches.church');
    });
});

// Website routes
Route::middleware(['web'])->controller('\Bishopm\Hub\Http\Controllers\HomeController')->group(function () {
    Route::get('/', 'home')->name('web.home');
    Route::post('/', 'home')->middleware(ProtectAgainstSpam::class)->name('web.home');
    Route::get('/blog/{year}/{month}/{slug}', 'blogpost')->name('web.blogpost');
    Route::get('/groups', 'groups')->name('web.groups');
    Route::get('/groups/{slug}', 'group')->name('web.group');
    Route::get('/projects', 'projects')->name('web.projects');
    Route::get('/projects/{slug}', 'project')->name('web.project');
    Route::get('/venues', 'venues')->name('web.venues');
    Route::get('/venues/{slug}', 'venue')->name('web.venue');
    Route::get('/week/{monday?}', 'week')->name('web.week');
    Route::get('/subject/{slug}', 'subject')->name('web.subject');
    if (substr(url()->current(), strrpos(url()->current(), '/' )+1)<>"admin"){
        Route::get('/{page}', 'page')->name('web.page');
    }
});


