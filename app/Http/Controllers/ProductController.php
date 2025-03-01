<?php

namespace App\Http\Controllers;

use App\Models\location;
use App\Models\product;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = product::all();
        return response()->json($product, 200);
    }
    /*
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = product::find($id);
        return response()->json($product, 200);
    }
    /*
     * Show the form for creating a new resource.
     */
    public function create() {}

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product_checker = $request->validate(
            [
                "name" => "required",
                "amount" => "required",
                "price" => "required",
                // "image"=>"file",
            ]
        );
        $product = new product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->amount = $request->amount;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->is_trendy = $request->is_trendy;
        $product->is_available = $request->is_available;

        if ($request->hasfile('image')) {
            $image = $request->file("image");
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image = Storage::disk("public")->putFileAs("/uploads/products", $image, $filename);
            $product->image = $filename;
            $product->save();
            return response()->json(["message" => "product added", 201]);
        } else {
            try {
                $product->save();
            } catch (\Throwable $e) {
                return response($e, 502);
            }
            return response()->json(["message" => "product added , no picture (default picture)", 201]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /*
     ! Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //? i should go to sleep
        $product_find = Product::find($id);
        $product_find->name = $request->name;
        $product_find->price = $request->price;
        $product_find->brand_id = $request->brand_id;
        $product_find->category_id = $request->category_id;
        $product_find->discount = $request->discount;
        $product_find->amount = $request->amount;
        $product_find->is_available = $request->is_available;
        $product_find->is_trendy = $request->is_trendy;
            if ($request->hasFile("image"))
            {
                $path = storage_path("app/public/uploads/products/" . $product_find->image);

                    if(\Illuminate\Support\Facades\File::exists($path))
                    {
                        \Illuminate\Support\Facades\File::delete($path);
                    }
                    $image = $request->file("image");
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $image = Storage::disk("public")->putFileAs("/uploads/products", $image, $filename);
                    $product_find->image = $filename;
                    $product_find->save();
                    return response()->json(["message" => "product updated "], 200);
            }
                $product_find->save();
                return response()->json(["message" => "product added , no new picture (default picture)", 201]);
    }
    /*
                    * Remove the specified resource from storage.
                    */
    public function destroy($id)
    {
        $product_id = product::find($id);
        if ($product_id) {
            $product_id->delete();
            return response()->json('product deleted');
        }
        return response('product is not exist , try with another ');
    }
}
