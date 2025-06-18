<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WorkController;

Route::controller(PageController::class)->group(function () {
    Route::get('/',        'home')->name('home');
    Route::get('/about',   'about')->name('about');
    Route::get('/team',    'team')->name('team');
    Route::get('/contact', 'contact')->name('contact');
});

Route::resource('work', WorkController::class)->only(['index', 'show']);


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('work', \App\Http\Controllers\Admin\WorkItemController::class);
    Route::resource('team', \App\Http\Controllers\Admin\TeamMemberController::class);

});