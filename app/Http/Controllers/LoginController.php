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
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // exit;
        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_name', $user->name);

            return redirect('/display')->with('success', 'Login Successful');
        }
        return redirect()->back()->with('error', 'Email and password does not match');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Logged Out SuccessFully');
    }
}
