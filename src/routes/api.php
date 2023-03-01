<?php

use Illuminate\Support\Facades\Route;
use Onsite\Tracker\Http\Controllers\TimeTrackerController;

Route::post('api/timeTrack', [TimeTrackerController::class, 'store']);
