<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return inertia('About', [
            'users' => $users, 
            'searchTerm' => $request->search,
            'can' => [
                'delete_user' => Auth::user() ? Auth::user()->can('delete', User::class) : null
            ],
        ]);
    }

    public function dashboard(){
        return inertia('Dashboard');
    }
}
