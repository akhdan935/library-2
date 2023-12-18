<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('users.login', [
            'title' => 'Login'
        ]);
    }

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/home')->with('success', 'Login successfull');
        }

        return back()->with('danger', 'Login failed!')->withInput();
    }
    
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out');
    }
    
    public function register()
    {
        return view('users.register', [
            'title' => 'Register'
        ]);
    }

    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:5|max:255|unique:users',
            'password' => 'required|min:5|max:255',
            'confirm' => 'required|same:password'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/')->with('success', 'Registration successfull! Please login');
    }
}
