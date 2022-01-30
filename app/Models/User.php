<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "avatar",
        'name',
        'username',
        'password',
        "role_id"
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


    /**
     * Get role for user 
     * @relat  `Many To One`
     * 
     */
    public function role() 
    {

        return $this->belongsTo(Role::class);
    }

    /**
     * Get info profile for sick  
     * @relat `One To One`
     * 
     */
    function sickInfo()
    {
        return $this->hasOne(SickInfo::class); 
    }

    /**
     * Check role 
     * 
     * @param array $names 
     * @return bool
     */
    function hasRoles($names) {

        return in_array($this->role->name, $names);
    }
}
