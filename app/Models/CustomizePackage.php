<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizePackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'image', // Add 'images' to the fillable array
    ];

    protected $casts = [
        'image' => 'json', // Cast 'images' as an array
    ];

}
