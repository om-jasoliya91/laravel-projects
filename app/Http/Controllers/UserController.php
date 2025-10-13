<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

    protected $hidden = ['password', 'name', 'remember_token'];
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

    public function show()
    {
        // Correct: returns Paginator
        $users = User::paginate(10);  // 10 users per page

        return view('user', compact('users'));
    }

    //  public function show()
    // {
    //     // Paginate 10 users per page
    //     $users = User::paginate(10);

    //     return view('user', compact('users'));
    // }
    public function redis()
    {
        //  Store all users in Redis cache for 60 minutes
        Cache::put('users', User::all(), 60);

        // Retrieve cached users (if exists)
        $usersFromCache = Cache::get('users');

        // OR use remember pattern (fetch from DB only if not cached)
        $users = Cache::remember('users', 60, function () {
            return User::all();
        });

        // Return to Blade view
        return view('users.index', compact('users'));
    }

    public function testRedis()
    {
        // Store a value in Redis for 10 minutes
        Cache::put('test_key', 'Hello Redis', 10);

        // Retrieve the value
        $value = Cache::get('test_key');

        // Show it
        return $value;
    }
}
