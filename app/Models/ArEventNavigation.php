<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArEventNavigation extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_name',
        'location',
        'ar_navigation_url',
    ];
}
