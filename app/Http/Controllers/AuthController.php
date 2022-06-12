<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Nette\Utils\Json;

class AuthController extends Controller
{
    public function postLogin(Request $request){
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        $cre = $request->only("email", "password");
        if(Auth::attempt($cre)){
            $user = Auth::user();
            return redirect('/')->with("success", "Welcome " . $user->name . " !");
        }else{
            return redirect()->back()->withErrors(["errors" => "Email or password do not match!"]);
        }
    }
    public function showLogin(){
        return Inertia::render("Auth/Login");
    }
    public function postRegister(Request $request){
        $request->validate([
            'name' => "required",
            'email' => "required|unique:users",
            'password' => "required|min:5",
        ]);
        // Create
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $cre = $request->only("email", "password");
        if(Auth::attempt($cre)){
            return redirect("/")->with("success", "Welcome " . $request->name . " !");
        }

        // Auth
    }
    public function showRegister(){
        return Inertia::render("Auth/Register");
    }
    public function logout(){
        Auth::logout();
        return redirect("/login");
    }
}
