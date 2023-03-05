<?php

namespace Onsite\Tracker\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Onsite\Tracker\Models\TimeTracker;

class TimeTrackerReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $field = $request->field;

        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');

        $sDate = date("Y-m-d", strtotime($request->from_date));
        $eDate = date("Y-m-d", strtotime($request->end_date));

        $query = TimeTracker::select('users.name', 'users.email')
            ->leftJoin('users', 'time_trackers.user_id', '=', 'users.id')
            ->groupBy('user_id');

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
        return view("tracker::report", compact('data'));
    }
}
