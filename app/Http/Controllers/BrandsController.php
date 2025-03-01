<?php

namespace App\Http\Controllers;

use App\Models\brands;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = brands::all();
        return response()->json(["name_brands" => $brands], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = Brands::find($id);
        if ($brand) {
            return response()->json([
                "name" => $brand,
            ], 200);
        }
        return response("the specific isn't exist");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                "name" => "required"
            ]);
            brands::create($validate);
            return response("created successfully", 200);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validate = $request->validate([
                "name" => "required"
            ]);
            $brand_find = brands::find($id);
            if ($brand_find) {
                brands::where("id", $id)->update($validate);
                return response()->json(["brands_updated" => brands::find($id)], 200);
            }
            return response()->json("the brand isn't exist");
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
    /*
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brands::find($id);
        $brand->where("id", $id)->delete();
        return response("brands deleted succesfully");
    }
}
