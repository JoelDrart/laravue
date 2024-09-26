<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        sleep(1);
        //Validate the request
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed'
        ]);

        // dd('All good');
        //Register the user
        $user = User::create($fields);

        //Send the user a welcome email {optional}

        //Log the user in
        Auth::login($user);

        //Redirect the user to the home page
        return redirect()->route('home');

        //dd($request);
    }

    public function login(Request $request){
        sleep(1);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
 
            return redirect()->route('home');
        }
 
        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        sleep(1);

        Auth::logout();
 
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
