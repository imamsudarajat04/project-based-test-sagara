<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {   
        // Check if user is already logged in
        if(Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function todoLogin(Request $request)
    {   
        // Validate the form data
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ], [
            'email.required'    => 'Email is required',
            'email.email'       => 'Email is invalid',
            'password.required' => 'Password is required'
        ]);

        // Check if user is already logged in
        $remember = $request->has('remember') ? true : false;

        // Attempt to log the user in
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('dashboard');
        }

        // Redirect back if login fails
        Alert::error('Error', 'Email or password is wrong');
        return redirect()->back();
    }

    public function logout()
    {
        // Logout the user
        Auth::logout();

        // Redirect to login page
        Alert::success('Success', 'You have been logged out');
        return redirect()->route('login');
    }
}
