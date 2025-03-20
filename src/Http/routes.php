<?php

use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

// Website routes
Route::middleware(['web'])->controller('\Bishopm\Hub\Http\Controllers\HomeController')->group(function () {
    Route::get('/', 'home')->name('web.home');
    Route::post('/', 'home')->middleware(ProtectAgainstSpam::class)->name('web.home');
    Route::get('/blog/{year}/{month}/{slug}', 'blogpost')->name('web.blogpost');
    Route::get('/groups', 'groups')->name('web.groups');
    Route::get('/subject/{slug}', 'subject')->name('web.subject');
    if (substr(url()->current(), strrpos(url()->current(), '/' )+1)<>"admin"){
        Route::get('/{page}', 'page')->name('web.page');
    }
});


