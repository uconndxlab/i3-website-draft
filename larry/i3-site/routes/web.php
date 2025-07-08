<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WorkController;

Route::controller(PageController::class)->group(function () {
    Route::get('/',        'home')->name('home');
    Route::get('/story',   'story')->name('story');
    Route::get('/people',    'team')->name('team');
    Route::get('/connect', 'connect')->name('connect');
});

Route::resource('projects', WorkController::class)->only(['index']);
Route::get('projects/{tag}', [WorkController::class, 'index'])
    ->name('projects.tag')
    ->where('tag', '[a-zA-Z0-9-]+');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('work', \App\Http\Controllers\Admin\WorkItemController::class);
    Route::resource('team', \App\Http\Controllers\Admin\TeamMemberController::class);

});