<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'booking_date',
        'price',
        'booking_status',
        'price_status',
        'booking_type',
        'start_date',
        'end_date',
    ];
}
