<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\Booking;
use App\Models\Admin;
use App\Models\User;

class Refund extends Model
{
    use HasFactory;
    protected $table = 'refunds';

    // Define the primary key column (if different from the default 'id')
    protected $primaryKey = 'id';



    public function booking()
    {
        // use User model
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }
}
