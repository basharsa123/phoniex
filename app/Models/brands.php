<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands extends Model
{
    /** @use HasFactory<\Database\Factories\BrandsFactory> */
    use HasFactory;
    protected $hidden = ["created_at" , "update_at"];
    protected $fillable = ["name"];
}