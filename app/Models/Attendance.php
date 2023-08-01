<?php
// app/Models/Attendance.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'name',
        'designation',
        'companyname',
        'role',
        'present',
        'user_id',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
