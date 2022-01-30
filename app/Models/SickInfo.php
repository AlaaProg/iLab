<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SickInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'gender',
        'age',
        'phone',
        'user_id'
    ];


    function user() 
    {
        return $this->belongsTo(User::class);
    }
}
