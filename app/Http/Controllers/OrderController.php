<?php

namespace App\Http\Controllers;

use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function pending(){
        $order = ProductOrder::where("user_id", Auth::user()->id)->where("status", "pending")->latest()->with("product")->paginate(10);
        return Inertia::render("OrderList", ["order" => $order]);
    }
    public function complete(){
        $order = ProductOrder::where("user_id", Auth::user()->id)->where("status", "complete")->latest()->with("product")->paginate(10);
        return Inertia::render("OrderList", ["order" => $order]);
    }
}
