<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckUPResource extends JsonResource
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
            "file" => $this->file,
            "notes" => $this->notes,
            "lab" => [
                "id" => $this->lab->id,
                'name' => $this->lab->name,
            ],
            "sick" => [
                "id" => $this->sick->id,
                'name' => $this->sick->name
            ],
        ];
    }
}
