<?php

namespace App\Resources\Time;

use Illuminate\Http\Resources\Json\JsonResource;

class Time extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time' => $this->time,
            'date' => $this->date
        ];
    }
}
