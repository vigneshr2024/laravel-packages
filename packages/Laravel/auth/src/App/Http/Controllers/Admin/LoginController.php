<?php

namespace Laravel\Auth\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function viewLogin()
    {
        return view('auth::admin.login');
    }

    public function login(Request $request)
    {
        $validated = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $request->session()->regenerate();
            return redirect(env('AUTH_PACKAGE_REDIRECT_URL'));
        }
        $request->session()->put('message', 'Invalid Credentials');
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('auth/admin/login');
    }
}
