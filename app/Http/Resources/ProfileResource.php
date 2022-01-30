<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "username" => $this->username,
            "avatar" => $this->avatar,
            "created_at" => $this->created_at,
            "role" => $this->when($this->role, function(){
                return  $this->role->name;
            }) ,
            "info" => $this->when($this->sickInfo, function(){
                return  [
                    "gender" => $this->sickInfo->gender,
                    "age" => $this->sickInfo->age,
                    "phone" => $this->sickInfo->phone,
                ];
            }),
        ];
    }
}
