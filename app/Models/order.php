<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'location_id' ,
        'status' ,
        'total_price' ,
        'date_of_deliver'
    ];
    public function user()
    {
        return $this->BelongsTo(User::class ,"user_id");
    }
    public function location()
    {
        return $this->BelongsTo(location::class ,"location_id");
    }
    public function items()
    {
        return $this->hasMany(order_items::class );
    }
}
