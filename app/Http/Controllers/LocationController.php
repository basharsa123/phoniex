<?php

namespace App\Http\Controllers;

use App\Models\location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = location::all();
        return response()->json($locations, 200);
    }
    /*
     * Display the specified resource.
     */
    public function show($id)
    {
        $location = location::find($id);
        return response()->json($location, 200);
    }
    /*
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json(["message" => Auth::id()], 201);


        $location_checker = $request->validate(
            [
                "street" => "required",
                "building" => "required",
                "area" => "required",
            ]
        );

        location::create([
            "street" => $request->street,
            "building" => $request->building,
            "area" => $request->area,
//            "user_id" => Auth::id()
//            "user_id" => 1,
        ]);
        return response()->json(["message" => "location added", 201]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $location_id = location::find($id);
        $location_checker = $request->validate([
            "street" => "required",
            "building" => "required",
            "area" => "required",
        ]);
        if ($location_id) {
            try {
                $location_id->update([
                    "street" => $request["street"] ,
                    "building" => $request["building"] ,
                    "area" => $request["area"] ,
                ]);
            }
            catch (\Exception $e) {return response($e);}
            return response()->json($location_id,201);
        }
        return response()->json('user not exist ,try with another location');
    }
    /*
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location_id = location::find($id);
        if ($location_id) {
            $location_id->delete();
            return response()->json('location deleted');
        }
        return response('location is not exist , try with another ');
    }
}
