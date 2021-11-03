<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    function index() {
        if (Auth::user() instanceof User) {
            User: $user = Auth::user();

            if ($user->super) {
                $users = User::all()->all();

                return view("admin.users.users")->with('users', $users);
            }
            return redirect(route("home"));
        }
    }

    function admin(User $user2, int $admin) {
        if (Auth::user() instanceof User) {
            User: $user = Auth::user();

            if ($user->super) {
                $user2->super = $admin == 1;
                $user2->save();
                return redirect(route("users"));
            }
            return redirect(route("home"));
        }
    }

    function delete(User $user2) {
        if (Auth::user() instanceof User) {
            User: $user = Auth::user();

            if ($user->super) {
                $user2->delete();

                return redirect(route("users"));
            }
            return redirect(route("home"));
        }
    }
}
