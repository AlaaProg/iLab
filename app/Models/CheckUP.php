<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUP extends Model
{
    use HasFactory;

    protected $table = 'checkups';

    protected $fillable = [
        "file",
        "notes",
        "sick_id",
        "lab_id",
    ];  


    /**
     * Get user sick 
     * Many To One
     */
    function sick() 
    {

        return $this->belongsTo(User::class, "sick_id");
    }

    /**
     * Get user lab 
     * Many To One
     */
    function lab() 
    {

        return $this->belongsTo(User::class, "lab_id");
    }
}
