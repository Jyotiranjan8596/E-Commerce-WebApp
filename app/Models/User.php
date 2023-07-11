<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
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
        'password' => 'hashed',
    ];

    //access to filament
    public function canAccessFilament(): bool
    {
        return $this->hasRole(['admin', 'Maintainer']);
    }

    //relation with cart
    public function cart(): HasMany
    {
        return $this->hasMany('App\Models\Cart', 'userId');
    }

    //relation with address
    public function address(): HasMany
    {
        return $this->hasMany('App\Models\Address', 'user_id');
    }

    //relation with orders
    public function orders(): HasMany
    {
        return $this->hasMany('App\Models\Order', 'userId');
    }
}

