<?php 

namespace App\Repositories;

use App\Repositories\Interfaces\BaseInterface;


class BaseRepository implements BaseInterface {

    protected $model;

    /**
     * Set model 
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void 
     */
    function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * upload file 
     * 
     * @param array $validated 
     * @return void 
     */
    function uploadFile(mixed &$validated, $key) 
    {
        if (isset($validated[$key])) 
        {
            $avatar = $validated[$key]->store("public");
            
            $validated[$key] = explode("/", $avatar)[1];
        } 
    }

    /**
     * Get All 
     * 
     * @return array
     */
    function all()
    {

        return $this->model::all();
    }

    /**
     * Filter like 
     * 
     * @param string $field 
     * @param string $query defualt "" 
     * @return Illuminate\Database\Eloquent\Model
     */
    function filterLike($field, $query="")
    {

        return $this->model::where($field, "LIKE", "%$query%");
    }

    /**
     * Get item by id or abort failed
     * 
     * @param int $id 
     * @return $model; 
     */
    function get($id)
    {
        
        $item = $this->model::find($id);

        if (!$item) {
            return abort(response()->json([
                "success" => false,
                "message" => __("Not found $id")
            ], 404)); 
        }

        return $item;
    }
    /**
     * update item by id 
     * 
     * @param array $validatedData 
     * @param int   $id
     * 
     * @return $model; 
     */
    function update($validatedData, $id)
    {
        $item = $this->get($id);
        $item->fill($validatedData)->save();
        return $item;
    }

    /**
     * Create new item 
     * 
     * @param array $validateData 
     * @return Model $model;
     */
    function create($validatedData)
    {
        return $this->model::create($validatedData);
    }

    /**
     * Delet item by Id 
     * 
     * @return void
     */
    function delete($id)
    {

        $item = $this->get($id);
        $item->delete();
    }
}