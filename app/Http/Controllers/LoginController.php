<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function loginTeacher(Request $request)
    {
        $res = [
            'code' => 0,
            'result' => [
                'username' => '',
                'first_name' => '',
                'last_name' => '',
                'roll' => ''
            ]
        ];

        try {
            $user = Teacher::where('username', $request->username)
                ->where('password', $request->password)
                ->get();

            if (count($user) > 1 || count($user) == 0) {
                $res['code'] = 403;
                return response()->json($res);
            }

            $res['result']['username'] = $user[0]->username;
            $res['result']['first_name'] = $user[0]->first_name;
            $res['result']['last_name'] = $user[0]->last_name;
            $res['result']['roll'] = $user[0]->roll;

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
}
