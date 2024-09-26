<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        return inertia('Home');
    }

    public function about()
    {
        $users = User::all();
        return inertia('About', ['users' => $users]);
    }

    public function dashboard(){
        return inertia('Dashboard');
    }
}
