<?php

namespace App\Http\Controllers;

use App\Models\TeacherConsults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\MainService;

class TeacherConsultController extends Controller
{
    public function getConsultByTId(Request $request)
    {
        try {
            $getConsult = TeacherConsults::where("t_id", '=', $request->t_id)
                ->orderBy('id', 'DESC')
                ->get();

            $settings = MainService::getTermAndYear();

            if (count($getConsult) == 0) {
                TeacherConsults::insert([
                    "t_id" => $request->t_id,
                    "class" => 1,
                    "room" => 1,
                    "year" => $settings->year,
                ]);
            } else {
                if ($getConsult[0]['year'] != $settings->year) {
                    TeacherConsults::insert([
                        "t_id" => $request->t_id,
                        "class" => 1,
                        "room" => 1,
                        "year" => $settings->year,
                    ]);
                }
            }

            $getConsult = TeacherConsults::where("t_id", '=', $request->t_id)
                ->orderBy('id', 'DESC')
                ->get();

            return ["code" => 0, "result" => $getConsult];
        } catch (\Throwable $th) {
            Log:info($th);
            return ["code" => 1];
        }
    }

    public function editConsultByTid(Request $request)
    {
        try {
            $getConsult = TeacherConsults::where("t_id", '=', $request->t_id)
                ->where('year', '=', $request->year)
                ->orderBy('id', 'DESC')
                ->first();

            if($getConsult){
                TeacherConsults::where('id', '=', $getConsult->id)
                ->update([
                    "class" => $request->class,
                    "room" => $request->room
                ]);

            }else{
                return ["code" => 400];
            }

            return ["code"=> 0];

        } catch (\Throwable $th) {
            Log:info($th);
            return ["code" => 1];
        }
    }
}
