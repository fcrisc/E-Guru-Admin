<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BatchClassroomResource extends JsonResource
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
            'id' => $this->id,
            'classroom' => $this->classroom,
            'batch' => $this->batch,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
