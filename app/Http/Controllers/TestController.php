<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return "test get index";
    }

    public function create(Request $request)
    {
        return $request;
    }
}