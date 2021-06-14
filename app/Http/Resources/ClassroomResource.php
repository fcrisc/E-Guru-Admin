<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'classroom_name' => $this->classroom_name,
            'classroom_code' => $this->classroom_code,
            'classroom_description' => $this->classroom_description,
            'classroom_status' => $this->classroom_status,
        ];
    }
}
