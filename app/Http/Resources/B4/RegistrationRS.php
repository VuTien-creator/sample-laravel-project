<?php

namespace App\Http\Resources\B4;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationRS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $session_ids = [];
        foreach($this->session_registration as $item){
            array_push($session_ids,$item->session_id);
        }
        return [
            'campaign' => [
                'id' => $this->ticket->campaign->id,
                'name' => $this->ticket->campaign->name,
                'slug' => $this->ticket->campaign->slug,
                'date' => $this->ticket->campaign->date,
                'organizer' => [
                    'id' => $this->ticket->campaign->organizer->id,
                    'name' => $this->ticket->campaign->organizer->name,
                    'slug' => $this->ticket->campaign->organizer->slug,
                ],
            ],
            'session_ids' => $session_ids
        ];
    }
}
