<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable =[
        "name", "brand_id" ,
         "category_id" , "price" ,
        "amount" ,"discount" ,"is_available" ,"is_trendy" ,"image"
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class ,"category_id");
    }
    public function brand()
    {
        return $this->belongsTo(Categories::class ,"brand_id");
    }
}
