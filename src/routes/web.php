<?php

use Illuminate\Support\Facades\Route;
use Onsite\Tracker\Http\Controllers\TimeTrackerController;

Route::get('timeTrack', [TimeTrackerController::class, 'index']);
