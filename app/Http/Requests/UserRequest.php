<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rule if user is admin 
     * 
     * @param array $rules 
     * @param bool  $isUpdate 
     * @return void 
     */
    private function getValidateRole(mixed &$rules, $isUpdate=false) 
    {
        if ($this->user()->hasRoles(['admin'])) {
            if ($isUpdate) {

                $rules['role'] = "exists:roles,name";
            } else {

                $rules['role'] = "required|exists:roles,name";
            }
        }   
    }

    /**
     * Get the validation rules if user is sick 
     * 
     * @param array $rules 
     * @param bool $isUpdate 
     * @return void 
     */
    private function getValidateSickInfo(mixed &$rules, $isUpdate=false) 
    {
        
        if ($isUpdate){
            $rules['gender'] = [
                'string', Rule::in(['male', 'famale']),
            ];
            $rules['phone'] = 'between:11,15';
            $rules['age'] = 'integer';

        } else {
            $rules['gender'] = [
                'required',
                'string', 
                Rule::in(['male', 'famale']),
            ];
            $rules['phone'] = 'required|between:11,15';
            $rules['age'] = 'required|integer';
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()){
            case "POST":
                $rules = [
                    "name" => "required|string",
                    "username" => "required|unique:users",
                    "password" => "required|min:8",
                ];

                // validation rules for role 
                $this->getValidateRole($rules);

                // Get validation rules for sick info 
                if ($this->role == "sick"){

                    $this->getValidateSickInfo($rules);
                }
                
                return $rules; 

            case "PUT":
                $userId = $this->user ? $this->user : auth()->id();
                
                $rules = [
                    "name" => "string",
                    "username" => "string|unique:users,id,".$userId,
                    "avatar" => "image|nullable",
                    "password" => "string|nullable",  
                ];  

                // validation rules for role 
                $this->getValidateRole($rules, true);


                // Get validation rules for sick info 
                if (User::find($userId)->hasRoles(['sick'])) {

                    $this->getValidateSickInfo($rules, true);
                }

                return $rules; 
        }
    }
}
