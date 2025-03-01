<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;
    protected $fillable=["user_id" , "street" , "building" , "area"];
    //?make relatoin between user_id in location table with user table.(location connect with it's user)
    public function user()
    {
        return $this->belongsTo(user::class , "user_id" );
    }
}
