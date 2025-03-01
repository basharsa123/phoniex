<?php

namespace App;

use Illuminate\Support\Facades\Storage;

trait add_image
{
    public function add_image($img , $path , $name_of_model )
    {
        //! under test
//        if ($request->hasFile("image"))
//        {
//            $path = storage_path("app/public/uploads/products/" . $product_find->image);
//
//            if(\Illuminate\Support\Facades\File::exists($path))
//            {
//                \Illuminate\Support\Facades\File::delete($path);
//            }
//            $image = $request->file("image");
//            $filename = time() . '.' . $image->getClientOriginalExtension();
//            $image = Storage::disk("public")->putFileAs("/uploads/products", $image, $filename);
//            $product_find->image = $filename;
//            $product_find->save();
//            return response()->json(["message" => "product updated "], 200);
//        }
    }
}
