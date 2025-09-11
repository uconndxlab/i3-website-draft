<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ContactController;

Route::controller(PageController::class)->group(function () {
    Route::get('/',        'home')->name('home');
    Route::get('/story',   'story')->name('story');
    Route::get('/people',    'team')->name('team');
    Route::get('/connect', 'connect')->name('connect');
    Route::get('/contact/success', 'contactSuccess')->name('contact.success');
    Route::get('/alumni',  'alumni')->name('alumni');
    
    // Merger route - only active after September 3, 2025
    Route::get('/merger', function () {
        if (now()->lt('2025-09-03')) {
            abort(404);
        }
        return app(PageController::class)->merger();
    })->name('merger');

    Route::get('/greenhouse-studios', function () {
        if (now()->lt('2025-09-03')) {
            abort(404);
        }
        return app(PageController::class)->greenhouse();
    })->name('greenhouse-studios');
});

Route::resource('projects', WorkController::class)->only(['index']);
Route::get('projects/{tag}', [WorkController::class, 'index'])
    ->name('projects.tag')
    ->where('tag', '[a-zA-Z0-9-]+');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/admin', function () {
    return redirect()->route('admin.contact-submissions.index');
})->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->middleware(['cas.auth', 'netid.auth'])->group(function () {
    Route::resource('work', \App\Http\Controllers\Admin\WorkItemController::class);
    Route::resource('team', \App\Http\Controllers\Admin\TeamMemberController::class);
    Route::resource('contact-submissions', \App\Http\Controllers\Admin\ContactSubmissionController::class)
        ->only(['index', 'show', 'destroy']);
    Route::patch('contact-submissions/{contact_submission}/mark-sent', 
        [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'markAsSent'])
        ->name('contact-submissions.mark-sent');
    Route::patch('contact-submissions/{contact_submission}/mark-unsent', 
        [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'markAsUnsent'])
        ->name('contact-submissions.mark-unsent');
    
    Route::resource('authorized-netids', \App\Http\Controllers\Admin\AuthorizedNetidController::class);
});