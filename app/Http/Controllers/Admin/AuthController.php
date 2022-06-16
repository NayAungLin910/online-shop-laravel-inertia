<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
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
        $data = [];

        $data["category"] = Category::count();
        $data["product"] = Product::count();
        $data["pending"] = ProductOrder::where("status", "pending")->count();
        $data["success"] = ProductOrder::where("status", "complete")->count();
        $data["users"] = User::latest()->take(5)->get();

        return Inertia::render("Admin/Dashboard", ["data" => $data]);
    }
}
