<?php

namespace App\Repositories\Interfaces;

interface UserInterface extends BaseInterface  {


    /**
     * Filter users by name and rolename  
     * 
     * @param string $name 
     * @param string $rolename 
     * @return Illuminate\Database\Eloquent\Model
     */
    function filter($name, $rolename);
}   