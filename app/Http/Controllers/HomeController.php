<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reimbursement;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexStaff()
    {
        $users = User::all();
        $submissions = Reimbursement::all();
        return view('staff.home', compact('submissions', 'users'));
    }

    public function indexFinance()
    {
        $users = User::all();
        $submissions = Reimbursement::where('status', '!=', 1)->get();
        return view('finance.home', compact('submissions', 'users'));
    }

    public function indexDirector()
    {
        $users = User::all();
        $submissions = Reimbursement::all();
        return view('director.home', compact('submissions', 'users'));
    }
}
