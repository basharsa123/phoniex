<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_items;
use App\Models\product;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use phpDocumentor\Reflection\Location;

class OrderController extends Controller
{
  public function index()
  {
    $orders = order::with("user")->paginate(3);
    if ($orders) {
      $name_of_order_product = [];
      foreach ($orders as $order) {
        foreach ($order->items() as $item) {
          $product = product::where("id", $item->product_id)->pluck("name");
          $order->name_of_product = $product["0"];
        }
      }
      return response()->json( $orders , 202);
    }
    return response()->json("no orders available" ,404);
  }
  public function show($id)
  {
    $order = order::with("user")->find($id);
    return response()->json($order, 200);
  }
  public function store(Request $request)
  {
    $location = \App\Models\location::where("user_id" , FacadesAuth::id())->first();
      try
      {
          $validation = $request->validate([
              "order_items" => "required",
              "total_price" => "required",
              "quantity" => "required",
              "date_of_deliver" => "required",
          ]);
          $new_order = new order();
          $new_order->user_id = FacadesAuth::id();
          $new_order->location_id = $location->id;
          $new_order->date_of_deliver = $request->date_of_deliver;
          $new_order->total_price = $request->total_price;
          $new_order->save();
          foreach ($request->order_items as $order_item) {
              $item = new order_items();
              $item["order_id"] = $new_order->id;
              $item["quantity"] = $order_item["quantity"];
              $item["price"] = $order_item["price"];
              $item["product_id"] = $order_item["product_id"];
              $item->save();
              $product = product::where("id", $order_item["product_id"]);
              $product->decrement("quantity", $item["quantity"]);
              $product->update();
          }
          return response()->json("order is added", 201);
      }catch (\Exception $e){
          return response()->json($e);
      }
  }
  public function get_order_item($id) {
      $order_items = order::where("order_id" ,$id)->get();
      if($order_items)
      {
          foreach ($order_items as $order_item) {
              $product = Product::where("id", $order_item->product_id)->pluck("name");
              $order_item->name_of_product = $product["0"];
          }
          return response()->json($order_items,201);
      }
      else
      {
          return response()->json("no orders available" ,404);
      }
  }
    public function get_user_orders($id)
    {
        $order = order::where("user_id" , $id)::with("items" , function($query){
            $query->orderBy("created_at" , "desc");
        })->get();
        if($order)
        {
        foreach ($order->items() as $order_item)
        {
            $product = product::where("id", $order_item->product_id)->pluck("name");
            $order_item->name_of_product = $product["0"];
        }
        return response()->json($order , 201);
        }
        return response()->json("no orders available" ,404);
    }
    public function change_order_status($id , Request $request)
    {
        $order = order::find($id);
        if($order)
        {
        $order->update(["status"=>$request->status]);
        response()->json($order , 200);
        }
        return response()->json("no orders available" ,404);
    }
}
