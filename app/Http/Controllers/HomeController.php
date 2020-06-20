<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function openDashboard(Request $request)
    {
        $user = $request->user();
        if ($user->is_student)
            return view('student.st_dashboard');
        else
            return view('instructor.ins_dashboard');
    }
}
