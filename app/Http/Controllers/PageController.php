<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;

class PageController extends Controller
{
    public function index(){
        $product = Product::with("category")->latest()->paginate("6");
        return Inertia::render("Index", ["product" => $product]);
    }
    public function productDetail($slug){
        $product = Product::where("slug", $slug)->with("category")->first();
        return Inertia::render("ProductDetail", ["product" => $product]);
    }
    public function productByCategory($slug){
        $category_id = Category::where("slug", $slug)->first()->id;
        $product = Product::where("category_id", $category_id)->with("category")->latest()->paginate("6");
        return Inertia::render("Index", ["product" => $product]);
    }
    public function searchProduct($search){
        $product = Product::where("name", "like", "%$search%")->with("category")->latest()->paginate("3");
        return Inertia::render("Index", ["product" => $product]);
    }
    
    // Add to Cart
    public function addToCart($id){

        // check if the smae product is in cart
        $isInCart = ProductCart::where("user_id", Auth::user()->id)->where("product_id", $id);

        if($isInCart->first()){
            // plus one qty
            $isInCart->update([
                "qty" => DB::raw("qty +  1"),
            ]);
            return redirect()->back()->with("info", "Product Quantity Increased!");
        }else{
            ProductCart::create([
                "user_id" => Auth::user()->id,
                "product_id" => $id,
                "qty" => 1, 
            ]);
            return redirect()->back()->with("success", "Added to Cart!");
        }
    }
    // View Cart
    public function viewCart(){
        $cart = ProductCart::where("user_id", Auth::user()->id)->latest()->with("product")->paginate(10);
        return Inertia::render("ViewCart", ["cart" => $cart]);
    }
    // View Check Out
    public function viewCheckOut(){
        return Inertia::render("CheckOut");
    }
    // Check OUt
    public function checkOut(Request $request){
        $request->validate([
            'phone' => "required",
            'address' => "required",
        ]);
        $cart = ProductCart::where("user_id", Auth::user()->id);
        foreach($cart->get() as $c){
            ProductOrder::create([
                "user_id" => Auth::user()->id,
                "product_id" => $c->product_id,
                "phone" => $request->phone,
                "address" => $request->address,
                "qty" => $c->qty,
            ]);
        }
        $cart->delete();
        return redirect("/")->with("success", "Check Out Successed ! We will call back soon !");
    }
}
