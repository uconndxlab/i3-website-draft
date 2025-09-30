<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the contact submission summary to run daily at 9 AM
Schedule::command('contact:send-summary')->dailyAt('09:00');

Schedule::command('github:fetch-commits')->dailyAt('00:00');