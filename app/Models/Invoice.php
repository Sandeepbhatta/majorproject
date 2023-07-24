<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'user_id', 
        'amount', 
        'status',
        'booking_id'

    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class,'booking_id', 'id');
    }
    public function user()
    {
        return $this->hasMany(User::class,'user_id', 'id');
    }

}
