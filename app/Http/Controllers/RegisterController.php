<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function regiView()
    {
        return view('register');
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'dob' => 'required|date',
            'age' => 'required|integer|min:18|max:100',
            'city' => 'required|string',
            'gender' => 'required|in:male,female',
            'hobby' => 'required|array',
            'salary' => 'nullable|integer|min:10000|max:100000',
            'password' => 'required|min:6|same:cpassword',
            'cpassword' => 'required|min:6',
            'address' => 'required|string|min:10',
            'profile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Convert hobbies array to comma-separated string
        $validated['hobby'] = implode(',', $validated['hobby']);

        // Handle profile image upload
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store the file in storage/app/public/uploads
            $path = $request->file('profile')->store('uploads', 'public');

            // Save the relative path in DB (uploads/filename.jpg)
            $validated['profile'] = $path;
        }

        // Hash password
        $validated['password'] = bcrypt($validated['password']);

        Employee::create($validated);

        return redirect()->back()->with('success', 'Employee Created Successfully.');
    }

    public function display()
    {
        $users = Employee::all();  // fetch all records
        // echo "<pre>";
        // print_r($users);
        // echo "</pre>";
        // exit;
        return view('display', compact('users'));  // load view and send data
    }

    public function editView($id)
    {
        $user = Employee::findOrFail($id);
        // here see id is availabel in database otherwise throw error
        // echo "<pre>";
        // print_r($user);
        // echo "</pre>";
        // exit;
        return view('edit', compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $user = Employee::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:2|string',
            'email' => 'required|email',
            'dob' => 'required|date',
            'age' => 'required|integer|min:18|max:100',
            'city' => 'required|string',
            'gender' => 'nullable|in:male,female',
            'hobby' => 'nullable|array',
            'salary' => 'nullable|integer|min:10000|max:100000',
            'address' => 'required|string|min:10',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Convert hobbies array to comma separated string
        $validated['hobby'] = $request->hobby ? implode(',', $request->hobby) : '';

        if ($request->hasFile('profile')) {
            if ($user->profile && file_exists(storage_path('app/public/' . $user->profile))) {
                unlink(storage_path('app/public/' . $user->profile));
            }

            // Store new image
            $path = $request->file('profile')->store('uploads', 'public');
            $validated['profile'] = $path;
        }

        $user->update($validated);

        return redirect('/display')->with('success', 'Employee Updated Successfully!');
    }

    public function deleteMultiple(Request $request)
    {
        $userIds = $request->input('user_ids', []);

        if (!empty($userIds)) {
            $users = Employee::whereIn('id', $userIds)->get();

            foreach ($users as $user) {
                if ($user->profile && file_exists(storage_path('app/public/' . $user->profile))) {
                    unlink(storage_path('app/public/' . $user->profile));
                }
            }

            Employee::whereIn('id', $userIds)->delete();

            return redirect()->back()->with('success', 'Selected users deleted successfully!');
        }

        return redirect()->back()->with('error', 'No users selected.');
    }
}
