<?php

namespace Onsite\Tracker\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Onsite\Tracker\Models\TimeTracker;

class TimeTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = "Time Tracking";
        $data['headline'] = "Time Tracking";

        $keyword = $request->keyword;
        $field = $request->field;

        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        $sDate = date("Y-m-d", strtotime($request->from_date));
        $eDate = date("Y-m-d", strtotime($request->end_date));

        $query = TimeTracker::groupBy('user_id');

        if (!empty($request->from_date) && !empty($request->end_date)) {
            $query->whereDate('date', '>=', $sDate)->whereDate('date', '<=', $eDate);
        } else {
            $query->whereDate('date', '>=', $start)->whereDate('date', '<=', $end);
        }

        $query->selectRaw("user_id, CONCAT(
                    FLOOR(TIME_FORMAT(SEC_TO_TIME(sum(seconds)), '%H') / 24), 'days - ',
                    MOD(TIME_FORMAT(SEC_TO_TIME(sum(seconds)), '%H'), 24), 'h : ',
                    TIME_FORMAT(SEC_TO_TIME(sum(seconds)), '%im : %ss')
                ) as times");

        $query->orderBy('times', 'desc');

        $data =  $query->paginate(50);
        return view("tracker::report", compact('data', 'data'));
    }

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
                'temp_seconds' => $sec,
            ];

            // existing data
            $find = TimeTracker::where('user_id', $data['user_id'])->whereDate('date', $data['date'])->first();
            if (!empty($find)) {
                if ($find->tos_session_key != $data['tos_session_key']) {
                    $data['seconds'] = $find->seconds + $find->temp_seconds;
                    $data['temp_seconds'] = 0;
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
