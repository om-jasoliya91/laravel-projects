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
        $user->name = 'omjasoliya';  // accessor will affect retrieval
        $user->email = 'omjasoliya2@gmail.com';
        $user->password = '123456';  // will be automatically hashed using 'password' cast
        $user->save();

        // Access the name attribute to see the accessor in action
        return 'Saved User Name (Uppercase via Accessor): ' . $user->name;
    }


    protected $hidden = ['password','name','remember_token'];
    // protected $visible = ['name', 'email'];

    public function hello()
    {
        $user = User::first();

        // convert into array

        // $array = $user->toArray();
        // print_r($array);

        // Converts the model to JSON string.

        // $json = $user->toJson();
        // echo $json;

        // Implicit JSON Serialization

        return response()->json(User::all());
    }
}
