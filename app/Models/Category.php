<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $table='categories';
    protected $fillable = [
        'name',
        'description',
        'feature',
        'image',
    ];

    public function packages()
    {
        return $this->belongsToMany(Package::class,'package_id', 'id');
    }
}
