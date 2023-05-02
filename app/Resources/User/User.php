<?php

namespace App\Resources\User;

use App\Resources\Mission\Mission as MissionResource;
use Illuminate\Http\Resources\Json\JsonResource;
class User extends JsonResource
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
            'id' => $this->id,
            'nome' => $this->nome,
            'cognome' => $this->cognome,
            'nomeUtente' => $this->nome_utente,
            'punteggio' => $this->punteggio,
            'mission' => $this->mission,
            'date' => $this->date
        ];
    }
}
