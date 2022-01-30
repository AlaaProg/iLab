<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ExsitsUserByRole;

class CheckUPRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch($this->method()){
            case "POST":
                return [
                    "file"  => "file|required",
                    "notes" => "nullable|string",
                    "sick"  => [
                        'required',
                        // check user id and role is sick 
                        new ExsitsUserByRole('sick')
                    ],
                    "lab"  => [
                        // check user id and role is lab
                        new ExsitsUserByRole('lab')
                    ]
                ];
            case 'PUT':
                return [
                    "file"  => "file",
                    "notes" => "nullable|string",
                    "sick"  => [
                        // check user id  and roel is sick 
                        new ExsitsUserByRole('sick')
                    ],
                    "lab"  => [
                        // check user id  and role is lab
                        new ExsitsUserByRole('lab')
                    ]
                ];
        }
    }
}
