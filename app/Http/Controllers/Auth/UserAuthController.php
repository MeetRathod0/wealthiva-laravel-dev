<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Mail\TestMail;

class UserAuthController extends Controller
{
    
    function updateUserStatus(Request $request)
    {
        $data = $request->validate([
            'id' => 'required'
        ]);

        $user = User::find($data['id']);
        $user->is_active = $user->is_active ? 0 : 1; // Toggle is_active status
        $user->updated_datetime = now(); // Update the timestamp
        $user->save();

        return response()->json(['message' => 'User status updated successfully']);
    }
    function registerfirstime(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return response()->json(['message' => 'Updated successfully']);
    }
    function updateEmailPhone(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'email' => 'required',
            'phone' => 'required',
        ]);

        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->save();

        return response()->json(['message' => 'Email and phone updated successfully']);
    }

    function updatePassword(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if (!Hash::check($data['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Current password is incorrect.'],
            ]);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return response()->json(['message' => 'Password updated successfully']);
    }
    /**
     * Register a new user and auto-login.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'sponsor_code' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'fullname' => 'required',
            'user_type_id' => 'required',
        ]);
        $data["is_verified"] = 0;
        $data["is_active"] = 0;
        $data["created_datetime"] = now();
        $data["updated_datetime"] = now();

        $user = User::create([
            ...$data,
            'password' => Hash::make($data['password']),
        ]);

        $parent = User::where('wg_id', $data['sponsor_code'])->value('id');

        DB::table("user_herarchy")->insert([
            'user_id' => $user->id,
            'parent_id' => $parent,
            'created_datetime' => now(),
            'updated_datetime' => now(),
            'created_by' => $parent,
        ]);

        try {
            Mail::to($user->email)->send(new TestMail([
                'title' => 'Your Registration is Successful.',
                'body' => 'Your user id is ' . $user->wg_id . '. Please login with your credentials.',
            ]));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            return response()->json(['error' => 'Failed to send registration email. Please contact support.'], 500);
        }

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
        ], 201);
    }

    /**
     * Login user by username + password (session-based).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('wg_id', $credentials['username'])
            ->where('is_active', 1)
            ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['Invalid credentials.'],
            ]);
        }

        Auth::guard('web')->login($user);
        session()->regenerate();

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
        ]);
    }

    /**
     * Logout from current session.
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json(['message' => 'Logged out successfully']);
        }

        return response()->json(['message' => 'No user is currently authenticated'], 401);
    }
    /**
     * Get currently authenticated user.
     */
    public function me(Request $request)
    {
        if (Auth::check()) {
            return response()->json(['user' => Auth::user()]);
        }

        return response()->json(['message' => 'Not authenticated'], 401);
    }

    public function getSponserIdName(Request $request)
    {
        $user = $request->validate([
            'sponsor_code' => 'required',
        ]);

        $sponsor = User::where('wg_id', $user['sponsor_code'])->first();
        if ($sponsor) {
            return response()->json([
                'sponsor_id' => $sponsor->wg_id,
                'sponsor_name' => $sponsor->fullname,
            ]);
        }
        return response()->json(['message' => 'Sponsor not found'], 404);

    }
}