<?php

namespace App\Http\Controllers;

use App\Models\Tcoures;
// use App\Services\MainServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TcouresController extends Controller
{
    // private MainServices $mainServices;

    // public function __construct(MainServices $mainServices)
    // {
    //     $this->mainServices = $mainServices;
    // }

    public function getSchedule()
    {
        $schedule = Tcoures::all();

        return response()->json($schedule);
    }

    public function getScheduleById(Request $request)
    {
        $tId = $request->t_id;

        try {
            $schedule = Tcoures::where('t_id', $tId)
                ->where('tc_term', $request->term)
                ->where('tc_year', $request->year)
                ->get();

            if(count($schedule) == 0){
                Tcoures::insert([
                    't_id' => $tId,
                    'tc_term' => $request->term,
                    'tc_year' => $request->year
                ]);

                $schedule = Tcoures::where('t_id', $tId)
                    ->where('tc_term', $request->term)
                    ->where('tc_year', $request->year)
                    ->get();
            }

            $res = [
                'code' => 0,
                'msg' => 'Success',
                'result' => $schedule[0]
            ];
        } catch (\Throwable $th) {
            Log::info($th);

            $res = [
                'code' => 1,
                'msg' => 'Success',
                'result' => []
            ];
        }

        return response()->json($res);
    }

    public function addAndEditSchedule(Request $request)
    {
        $tId = $request->t_id;

        $schedule = Tcoures::where('t_id', $tId)
            ->where('tc_term', $request->term)
            ->where('tc_year', $request->year)
            ->get();

        $textSchedule = $request->subject;

        $checkQuery = 0;
        $res = [];

        if (count($schedule) == 1) {
            try {
                $editSchedule = Tcoures::where('id', $schedule[0]->id)->update([
                    $request->column => $textSchedule
                ]);

                if ($editSchedule) {
                    $checkQuery = 1;
                }
            } catch (\Throwable $th) {
                $checkQuery = 0;
            }
        } else {
            try {
                $addSchedule = Tcoures::create([
                    't_id' => $tId,
                    'tc_term' => $request->term,
                    'tc_year' => $request->year,
                    $request->column => $textSchedule
                ]);

                if ($addSchedule) {
                    $checkQuery = 1;
                }
            } catch (\Throwable $th) {
                $checkQuery = 0;
            }
        }

        if ($checkQuery == 1) {
            $res = [
                'code' => 0,
                'msg' => 'Success'
            ];
        } else {
            $res = [
                'code' => 400,
                'msg' => 'Invalid Parameter'
            ];
        }

        return response()->json($res);
    }

    public function removeSchedule(Request $request)
    {
        $tId = $request->t_id;

        $schedule = Tcoures::where('t_id', $tId)
            ->where('tc_term', $request->term)
            ->where('tc_year', $request->year)
            ->get();

        $checkQuery = 0;
        $res = [];

        try {
            $editSchedule = Tcoures::where('id', $schedule[0]->id)->update([
                $request->column => null
            ]);

            if ($editSchedule) {
                $checkQuery = 1;
            }
        } catch (\Throwable $th) {
            $checkQuery = 0;
        }

        if ($checkQuery == 1) {
            $res = [
                'code' => 0,
                'msg' => 'Success'
            ];
        } else {
            $res = [
                'code' => 400,
                'msg' => 'Invalid Parameter'
            ];
        }

        return response()->json($res);
    }
}
