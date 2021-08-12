<?php

namespace App\Http\Resources\B2;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketRS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->special();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cost' => $this->cost,
            'available' => $this->available,
            'description' => $this->description
        ];
    }
}
