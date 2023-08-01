<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject; 

class User extends Authenticatable implements JWTSubject // Add JWTSubject here
{

    use HasApiTokens, HasFactory, Notifiable;
    // Your existing model code...


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Method required by JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    // Method required by JWTSubject
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function booking()
    {
        return $this->hasMany(Booking::class, 'booking_id', 'id');
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
