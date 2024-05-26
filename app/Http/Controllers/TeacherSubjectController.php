<?php

namespace App\Http\Controllers;

use App\Models\TeacherSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherSubjectController extends Controller
{
    public function getSubject(Request $request){
        try {
            $getDate = TeacherSubject::where('t_id', '=', $request->t_id)
                ->get();
            Log:info($getDate);
            return ["code" => 0, "result" => $getDate];
        } catch (\Throwable $th) {
            return ["code" => 0, "result" => []];
        }
    }

    public function insertSubject(Request $request)
    {

        try {
            $checkData = TeacherSubject::where('t_id', '=', $request->t_id)
                ->where('subject_code', '=', $request->subject_code)
                ->get();

            if (count($checkData) > 0) {
                return ["code" => 204];
            }

            $insert = TeacherSubject::insert([
                't_id' => $request->t_id,
                'subject_code' => $request->subject_code,
                'subject_name' => $request->subject_name,
                'term' => $request->term,
                'year' => $request->year,
            ]);

            return ["code" => 0];
        } catch (\Throwable $th) {
            return ["code" => 400];
        }
    }

    public function editSubject(Request $request)
    {
        try {

            if(!$request->id){
                return ["code" => 400];
            }

            $checkData = TeacherSubject::where('id', '=', $request->id)
                ->first();

            if (!$checkData) {
                return ["code" => 404];
            }

            $update = TeacherSubject::where('id', '=', $request->id)
                ->update([
                    'subject_code' => $request->subject_code,
                    'subject_name' => $request->subject_name,
                ]);

            return ["code" => 0];
        } catch (\Throwable $th) {
            Log:info($th);
            return ["code" => 400];
        }
    }
}
