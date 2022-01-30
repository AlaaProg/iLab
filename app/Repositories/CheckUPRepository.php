<?php

namespace App\Repositories;

use App\Models\CheckUP;
use App\Repositories\Interfaces\CheckUPInterface;
use Illuminate\Database\Eloquent\Builder;

class CheckUPRepository extends BaseRepository implements CheckUPInterface {
    
    // App\Models\User::class 
    protected $model = CheckUP::class;


    /**
     * Filter checkup by sick name 
     * 
     * @param string $name 
     * @return App\Models\CheckUP::class 
     */
    public function filterBySick($name)
    {   
        // filter checkup by sick name 
        $checkup = $this->model::whereHas('sick', function (Builder $query) use($name) {
            $query->where('name', 'like', "%$name%");
        });

        if (auth()->user()->hasRoles(["lab"])) {
            
            $checkup = $checkup->where("lab_id", auth()->id());
        }

        return $checkup;
    }

    /**
     * update user profile 
     * 
     * @param array $validatedData
     * @param int $id 
     * @return App\Models\CheckUP::class 
     */
    function update($validatedData, $id)
    {
        if (auth()->user()->hasRoles(["admin"])) {    

            $validatedData['lab_id'] =  $validatedData['lab'];
        }
        $this->uploadFile($validatedData, "file");
        $validatedData['sick_id'] = $validatedData['sick'];
        return parent::update($validatedData, $id);
    }

    /**
     * create new user 
     * 
     * @param array $validatedData
     * @return App\Models\CheckUP::class 
     */
    function create($validatedData)
    {
        if (auth()->user()->hasRoles(["lab"])) {

            $validatedData['lab_id'] = auth()->id();
        } else {
             
            $validatedData['lab_id'] =  $validatedData['lab'];
        }
        $this->uploadFile($validatedData, "file");
        $validatedData['sick_id'] = $validatedData['sick'];
        return parent::create($validatedData);
    }
}