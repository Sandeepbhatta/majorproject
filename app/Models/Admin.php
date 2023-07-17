<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;


class Admin extends Authenticatable implements CanResetPassword
{   
     
    use HasApiTokens, HasFactory, Notifiable, CanResetPasswordTrait;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $gaurd ='admin';
        protected $fillable = [
            'name',
            'email',
            'password',
            'status',
            'role',
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
    }
