<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin(){
        return Inertia::render("Admin/Login");
    }
    public function postLogin(){
        $cre = request()->only("email", "password");// get array
        if(Auth::attempt($cre)){
            // success
            $user = Auth::user();
            if($user->role == "admin"){
                // success
                return redirect("admin/dashboard");
            }else{
                // not admin
                return redirect("admin/login")->with("error", "You are not admin !"); 
            }
        }else{
            return redirect("admin/login")->with("error", "Email or password don't match !");
        }
    }
    public function dashboard(){
        $user = Auth::user();
        return Inertia::render("Admin/Dashboard", ["user" => $user]);
    }
}
