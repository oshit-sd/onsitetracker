<?php

namespace Onsite\Tracker\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Onsite\Tracker\Models\TimeTracker;

class TimeTrackerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $sec = (int)$request->timeOnSite;
            $data = [
                'date' => date('Y-m-d'),
                'user_id' => $request->user_id,
                'tos_session_key' => $request->TOSSessionKey,
                'seconds' => $sec,
            ];

            // existing data
            $find = TimeTracker::where('user_id', $data['user_id'])->whereDate('date', $data['date'])->first();
            if (!empty($find)) {
                if ($find->tos_session_key != $data['tos_session_key']) {
                    $data['seconds'] = $find->seconds + (int) $data['seconds'];
                }

                $find->update($data);
            } else {
                TimeTracker::create($data);
            }
        } catch (\Exception $ex) {
            Log::alert($ex);
        }
    }
}
