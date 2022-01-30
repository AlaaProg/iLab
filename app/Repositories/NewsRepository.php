<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Interfaces\NewsInterface;

class NewsRepository extends BaseRepository implements NewsInterface {
    
    // App\Models\News::class 
    protected $model = News::class;


    /**
     * update News profile 
     * 
     * @param array $validatedData
     * @param int $id 
     * @return App\Models\News::class 
     */
    function update($validatedData, $id)
    {

        $this->uploadFile($validatedData, "image");
        return parent::update($validatedData, $id);
    }

    /**
     * create new user 
     * 
     * @param array $validatedData
     * @return App\Models\News::class 
     */
    function create($validatedData)
    {

        $this->uploadFile($validatedData, "image");
        $validatedData['user_id'] = auth()->user()->id;
        return parent::create($validatedData);
    }
}