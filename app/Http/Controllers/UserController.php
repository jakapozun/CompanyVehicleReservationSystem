<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function my_reservations(User $user)
    {
        if($user->id == auth()->id()){
            return view('admin.reservations.my_reservations', compact('user'));
        }
        else{
            abort(403);
        }
    }

}
