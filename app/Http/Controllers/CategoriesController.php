<?php

namespace App\Http\Controllers;

use App\Models\brands;
use App\Models\Categories;
use Exception;
use Faker\Core\File;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\FileException;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Categories::all();
        return response()->json(["name_Categories" => $Categories], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = Categories::find($id);
        if ($brand) {
            return response()->json([
                "name" => $brand,
            ], 201);
        }
        return response("the specific isn't exist");
    }
    /*
     * Show the form for creating a new resource.
     */
    // public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                "name" => "required",
            ]);
            try {

                //! save the file to uploads/category
                $image = $request->file("image");
                $file_name =  time() . "." . $image->extension();
                $image = Storage::disk("public")->putFileAs( "/uploads/category" , $image ,$file_name );


                //? save to the database
                $create = new Categories;
                $create->name = $request->name;
                $create->image = $file_name;
                $create->save();
            } catch (Exception $e) {
                return response(["message" => $e ] , 520);
            }
            return response()->json(["created succcesfully" , 200]);
        }catch(FileException $e)
        {
            return response([$e ,520]);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {

        try {
            $categories_find = Categories::find($id);
            if ($categories_find)
            {
                $categories_find->name = $request->name;
                    if($request->hasFile("image"))
                    {
                        $path = storage_path("app/public/uploads/category/" . $categories_find->image);
                        if(\Illuminate\Support\Facades\File::exists($path))
                        {
                            \Illuminate\Support\Facades\File::delete($path);
                        }
                        $image = $request->file("image");
                        $filename = time() . '.' . $image->getClientOriginalExtension();
                        $image = Storage::disk("public")->putFileAs("/uploads/category" , $image, $filename);
                        $categories_find->image = $filename;
                        $categories_find->save();
                            return response()->json(["message" => "Category updated "], 200);
                    }
                $categories_find->save();
                return response()->json(["Categories_updated" => $categories_find], 200);
            }
            return response()->json("the Categories isn't exist");
        } catch (\InvalidArgumentException $e)
        {
            return response($e, 520);
        }

    }
    /*
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Categories::find($id);
        Storage::delete($brand->image);
        $brand->where("id", $id)->delete();
        return response("Categories deleted succesfully");
    }
}
