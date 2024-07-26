<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showDeleteUser()
    {
        // Fetch all users
         $users = User::all();  
         // Pass users data to the view  
         return view('deleteUser', ['users' => $users]);
    }

    public function showUpdateUser()
    {
        $users = User::all(); // Fetch all users
        return view('updateUser', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|min:8',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->password = bcrypt($request->password);

            if ($request->hasFile('profile_image')) {
                $path = $request->file('profile_image')->store('profile_images', 'public');
                $user->profile_image = $path;
            }

            $user->save();

            return redirect()->route('addUser')->with('success', 'User added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('addUser')->with('error', 'Failed to add user: ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        // Validate the request to ensure 'user_ids' is an array of integers
        $request->validate([       
            'user_ids' => 'required|array',    
            'user_ids.*' => 'integer|exists:users,id',    
        ]);   
        try {    
            User::whereIn('id', $request->input('user_ids'))->delete();    
            return redirect()->route('deleteUser')->with('success', 'Users deleted successfully.'); 
        } catch (\Exception $e) {    
            return redirect()->route('deleteUser')->with('error', 'Failed to delete users: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $users = User::all();
        return view('welcome', ['users' => $users]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user_id,
            'phone_number' => 'required|string|max:15',
            'new_password' => 'nullable|string|min:8',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::find($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
    
        // Update the password if a new password is provided
        if (!empty($request->new_password)) {
            $user->password = Hash::make($request->new_password);
        }
    
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }
        $user->save();
        return redirect()->back()->with('success', 'User updated successfully');
    }
    
    
}
