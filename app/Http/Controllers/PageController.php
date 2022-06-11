<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
}
