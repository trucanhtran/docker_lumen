<?php

namespace App\Http\Controllers;

use Log;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return view('test');
    }

    public function login(Request $request)
    {
        Log::info($request);
        Log::info('--------------------------------------------');
    }

    //
}
