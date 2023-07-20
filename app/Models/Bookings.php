<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\Admin;
use App\Models\User;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'package_id',
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
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
    public function user()
    {
        // use User model
        return $this->belongsTo(Admin::class, 'user_id', 'id');
    }
}
