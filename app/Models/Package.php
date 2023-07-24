<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rating; 
class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'image'

        
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, 'Booking_id', 'id');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'rating_id', 'id');
    }
}
