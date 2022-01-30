<?php 

namespace App\Repositories\Interfaces;

interface BaseInterface {

    /**
     * Set model 
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void 
     */
    function setModel($model);

    /**
     * upload file 
     * 
     * @param array $validated 
     * @return void 
     */
    public function uploadFile(mixed &$validated, $key);

    /**
     * Get All 
     * 
     * @return array
     */
    function all();

    /**
     * Filter like 
     * 
     * @param string $field 
     * @param string $query defualt "" 
     * @return Illuminate\Database\Eloquent\Model
     */
    function filterLike($field, $query="");

    /**
     * Get item by id or abort failed
     * 
     * @param int $id 
     * @return Model; 
     */
    function get($id);
    
    /**
     * update item by id 
     * 
     * @param array $validatedData 
     * @param int   $id
     * 
     * @return $model; 
     */
    function update($validatedData, $id);

    /**
     * Create new item 
     * 
     * @param array $validateData 
     * @return $model;
     */
    function create($validatedData);

    /**
     * Delet item by Id 
     * 
     * @return void
     */
    function delete($id);
}