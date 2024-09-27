<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        sleep(1);

        // if($request->hasFile('avatar')){
        //     Storage::disk('public')->put('avatars', $request->avatar); 
        // }
        // dd('All good'); 
        //Validate the request
        $fields = $request->validate([
            'avatar' => ['file', 'nullable', 'max:3000'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        if ($request->hasFile('avatar')) {
            $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);

            //Por si falla y sale el error: 'Path cannot be empty'
            //ve al php.ini y descomenta la variable upload_tmp_dir y coloca c:\windows\temp si usas xampp y C:/laragon/tmp si usas laragon
            //Reinicia el servidor y listo
        }else{
            $fields['avatar'] = 'avatars/defaultuser.jpg';
        }

        // dd('All good');
        //Register the user

        $user = User::create($fields);

        //Send the user a welcome email {optional}

        //Log the user in
        Auth::login($user);

        //Redirect the user to the home page
        return redirect()->route('dashboard')->with('message', 'Bienvenido a la plataforma');

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
 
            return redirect()->intended('dashboard');
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
