<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    use HasFactory;
    protected $fillable=[ "order_id" , "product_id" , "price" , "quantity"];
    public function order()
    {
        return $this->belongsTo(order::class , "order_id");
    }
    public function product()
    {
        return $this->belongsTo(product::class , "product_id");
    }

}
