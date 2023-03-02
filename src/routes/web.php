<?php

use Illuminate\Support\Facades\Route;
use Onsite\Tracker\Http\Controllers\TimeTrackerReportController;

Route::get('timeTrack', [TimeTrackerReportController::class, 'index']);
