<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use App\Models\Timetable;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class TimetableController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:Add Timetables', 'auth:admin'], ['only' => ['index', 'store']]);
        $this->middleware(['auth:web'], ['only' => ['userHome']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $pharmacies = Pharmacy::all();
        return view('dashboard.timetable.index', compact('users', 'pharmacies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'pharmacy_id' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'date' => 'required|date_format:Y-m-d',
        ]);


        $from = Carbon::parse($request->start_time);
        $to = Carbon::parse($request->end_time);
        $date =  $request->date;

        $timeSlots = Timetable::whereTime('start_time', '>=', $from)
            ->whereTime('end_time', '<=', $to)
            ->whereDate('date', '=', $date)
            ->get();


        if ($timeSlots->count() >= 1) {
            $msg = ['msg' => 'Time slot not available try another range', 'icon' => 'error', 'timeslots' => $timeSlots];
            return response()->json($msg, 200);
        }

        $input = $request->all();
        Timetable::create($input);

        $msg = ['msg' => 'Time slot added successfully', 'timeslots' => [], 'icon' => 'success'];
        return response()->json($msg, 200);
    }

    public function getDatesRange(Request $request)
    {
        $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after:from'
        ]);

        $startDate =  $request->from;
        $endDate =  $request->to;

        $dates = $this->generateDatesRange($startDate, $endDate);
        return $dates;
    }

    public function generateDatesRange($startDate, $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);

        $dates  = [];
        foreach ($period as $date) {
            $dates[] = [
                'date' => $date->format('Y-m-d'),
                'day_name' => Carbon::parse($date)->format('l'),
                'date_day' => $date->format('Y-m-d') .' - ' . Carbon::parse($date)->format('l')
            ];
        }
        return $dates;
    }

    public function userHome()
    {
        $pharmacies = Pharmacy::all();
        return view('user.timetable.index', compact( 'pharmacies'));
    }


    public function generateTimeTable(Request $request)
    {
        $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after:from',
            'pharmacy_id' => 'required'
        ]);

        $startDate = $request->from;
        $endDate = $request->to;
        $pharmacy_id = $request->pharmacy_id;
        $user_id = auth()->user()->id;

        $dateRange = $this->generateDatesRange($startDate, $endDate);

        $timeslots = Timetable::with('pharmacy')
            ->where(['user_id' => $user_id], ['pharmacy_id' => $pharmacy_id])
            ->where('pharmacy_id', $pharmacy_id)
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

            foreach ($timeslots as $timeslot) {
                $timeslot->date_day = $timeslot->date_day;
            }

            return ['date_range' => $dateRange, 'timeslots' => $timeslots];
    }
}
