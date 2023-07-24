<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'oid',
        'amt',
        'refId',
        'user_name', // Add any other fields you want to be mass-assignable here
    ];
}
