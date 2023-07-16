<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\Admin','user_id');
    }
    public function package(){
        return $this->belongsTo('App\Models\Package','Package_id');
    }
    protected $fillable = [
        'user_id',
        'package_id',
        'review',
        'rating',
        'status',
    ];
}
