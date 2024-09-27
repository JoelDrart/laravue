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

    public function about(Request $request)
    {
        $users = User::when($request->search, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        })->paginate(5)->withQueryString();
        return inertia('About', ['users' => $users, 'searchTerm' => $request->search]);
    }

    public function dashboard(){
        return inertia('Dashboard');
    }
}
