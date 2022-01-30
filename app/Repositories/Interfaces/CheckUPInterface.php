<?php

namespace App\Repositories\Interfaces;

interface CheckUPInterface extends BaseInterface  {


    /**
     * Filter checkup by sick name 
     * 
     * @param string $name 
     * @return App\Models\CheckUP::class 
     */
    public function filterBySick($name);
}   