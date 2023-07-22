<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
use App\Models\Rating;
use Symfony\Component\HttpFoundation\Response;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id', 
        'rating', 
        'review',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
