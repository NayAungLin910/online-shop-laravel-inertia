<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Psy\Readline\Hoa\Console;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return Inertia::render("Admin/Product/Index", ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = Category::all();
        return Inertia::render("Admin/Product/Create", ["cat" => $cat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'price' => 'required',
            'description' => 'required',
        ]);
        // store
        $file = $request->file('image');
        $name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path("/image"), $name);
        $image_name = "image/" . $name;
        Product::create([
            "slug" => Str::slug(uniqid() . $request->name),
            "name" => $request->name,
            "category_id" => $request->category_id,
            "image" => $image_name,
            "description" => $request->description,
            "price" => $request->price,
            "view_count" => 0,
        ]);
        return redirect()->back()->with("success", "Product Created Successfully !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p  =  Product::where("id", $id)->with("category")->first();
        return Inertia::render("Admin/Product/Detail", ["product" => $p]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $cat = Category::all();
        return Inertia::render("Admin/Product/Edit", ["product" => $product, "cat" => $cat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]); 

        $p = Product::where('id', $id);
         if($request->file('image')){
             $request->validate([
                'image' => 'mimes:png,jpg,jpeg',
             ]);
             File::delete($p->first()->image);
             $f = $request->file('image');
             $name = uniqid() . $f->getClientOriginalName();
             $image_path = "image/" . $name;
             $f->move(public_path('/image'), $name);
         }else{
             $image_path = $p->first()->image;
         }

         $p->update([
            "slug" => Str::slug(uniqid() . $request->name),
            "name" => $request->name,
            "category_id" => $request->category_id,
            "image" => $image_path,
            "description" => $request->description,
            "price" => $request->price,
            "view_count" => 0,
        ]);
        return redirect()->back()->with("success", "Product Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p  = Product::where('id', $id);

        File::delete($p->first()->image);
        $p->delete();

        return redirect()->back()->with("success", "Product Deleted Successfully !");
    }
}
