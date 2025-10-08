<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function authentication(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = Employee::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $user->name);

            return redirect('/display')->with('success', 'Login Successful');
        }

        return redirect('/login')->with('error', 'Email and password do not match');
    }

    public function logout()
    {
        Session::flush();  // remove all session data
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}
