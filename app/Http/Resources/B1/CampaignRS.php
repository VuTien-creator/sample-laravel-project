<?php

namespace App\Http\Resources\B1;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignRS extends JsonResource
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
            "id" => $this->id,
               "name" => $this->name,
               "slug" => $this->slug,
               "date" => $this->date,
               "organizer" => [
                  "id" => $this->organizer->id,
                  "name" => $this->organizer->name,
                  "slug" => $this->organizer->slug
               ]
        ];
    }
}
