<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Imports\TeacherImport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\MainService;

class LoginController extends Controller
{
    public function loginTeacher(Request $request)
    {
        $res = [
            'code' => 0,
            'result' => [
                'id' => '',
                'username' => '',
                'first_name' => '',
                'last_name' => '',
                'roll' => '',
                'term' => 0,
                'year' => 0
            ]
        ];

        try {
            $user = Teacher::where('username', $request->username)
                ->where('password', $request->password)
                ->get();
            
            $settings = MainService::getTermAndYear();

            if (count($user) > 1 || count($user) == 0 || !$settings) {
                $res['code'] = 403;
                return response()->json($res);
            }

            $res['result']['id'] = $user[0]->id;
            $res['result']['username'] = $user[0]->username;
            $res['result']['first_name'] = $user[0]->first_name;
            $res['result']['last_name'] = $user[0]->last_name;
            $res['result']['roll'] = $user[0]->roll;
            $res['result']['term'] = $settings->term;
            $res['result']['year'] = $settings->year;

            return response()->json($res);
        } catch (\Throwable $th) {
            Log::info($th);

            $res['code'] = 400;
            return response()->json($res);
        }
    }

    public function resetPasswordTeacher(Request $request)
    {

        $res = [
            'code' => 0,
            'msg' => 'Success'
        ];

        try {
            $user = Teacher::where('username', $request->username)
                ->get();

            if (count($user) > 1 || count($user) == 0) {
                $res['code'] = 403;
                return response()->json($res);
            }

            $edit = Teacher::where('username', $request->username)
                ->update([
                    'password' => $request->password
                ]);

            if ($edit) {
                return response()->json($res);
            } else {

                throw new Exception('Error Reset Password');
            }
        } catch (\Throwable $th) {
            Log::info($th);

            $res['code'] = 400;
            $res['msg'] = 'Fail';

            return response()->json($res);
        }
    }

    public function addUserTeacher(Request $request)
    {
        $res = [
            'code' => 0,
            'result' => [
                'username' => '',
                'password' => '',
                'first_name' => '',
                'last_name' => '',
                'roll' => '',
            ]
        ];

        try {
            $user = Teacher::where('username', $request->username)
                ->get();

            if (count($user) == 1) {
                $res['code'] = 201;
                return response()->json($res);
            }

            $add = Teacher::create([
                'username' => $request->username,
                'password' => $request->password,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'roll' => $request->roll,
            ]);

            if ($add) {

                $res['result']['username'] = $request->username;
                $res['result']['password'] = $request->password;
                $res['result']['first_name'] = $request->first_name;
                $res['result']['last_name'] = $request->last_name;
                $res['result']['roll'] = $request->roll;

                return response()->json($res);
            } else {

                throw new Exception('Error Add User ');
            }
        } catch (\Throwable $th) {
            Log::info($th);

            $res['code'] = 400;
            $res['msg'] = 'Fail';

            return response()->json($res);
        }
    }

    public function addUserTeacherExcel(Request $request)
    {

        try {
            if ($request->hasFile('file')) {

                $exfile = $request->file('file')->extension();

                if ($exfile == 'xlsx' || $exfile == 'csv') {

                    $filename = 'teacher' . '_' . time() . '.' . $exfile;
                    $request->file('file')->move('add_teacher', $filename);
                    Excel::import(new TeacherImport, 'add_teacher/' . $filename);

                    return response()->json([
                        'code' => 0,
                        'msg' => 'Add Teacher User Success'
                    ], 200);
                } else {
                    return response()->json([
                        'code' => 401,
                        'msg' => 'File Not Match'
                    ], 200);
                }
            } else {
                return response()->json([
                    'code' => 402,
                    'msg' => 'Pls Upload File'
                ], 200);
            }
        } catch (\Throwable $th) {
            Log::info($th);

            return response()->json([
                'code' => 400,
                'msg' => 'Add Teacher User Error '
            ], 200);
        }
    }
}
