<?php

namespace Laravel\User\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // dd(Auth::user()->name);
        return view('user::admin.dashboard');
    }
}
