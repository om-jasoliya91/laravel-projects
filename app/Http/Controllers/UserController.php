<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Create a new user instance
        $user = new User();
        $user->name = 'Om Jasoliya';  // accessor will affect retrieval
        $user->email = 'omjasoliya@gmail.com';
        $user->password = '123456';   // will be automatically hashed using 'password' cast

        $user->save();

        // Access the name attribute to see the accessor in action
        return "Saved User Name (Uppercase via Accessor): " . $user->name;
    }
}
