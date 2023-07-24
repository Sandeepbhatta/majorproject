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
        'user_id',
        'package_id',
        'booking_date',
        'start_date',
        'end_date',
    ];
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
    public function user()
    {
        // use User model
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
