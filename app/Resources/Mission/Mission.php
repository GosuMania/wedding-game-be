<?php

namespace App\Resources\Mission;

use Illuminate\Http\Resources\Json\JsonResource;

class Mission extends JsonResource
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
            'idUtente' => $this->id_utente,
            'parolaCruciverba' => $this->parola_cruciverba,
            'selfieSposa' => $this->selfie_sposa,
            'selfieSposo' => $this->selfie_sposo,
            'brindisi' => $this->brindisi,
            'videoBrindisi' => $this->video_brindisi,
            'parolaJenga' => $this->parola_jenga,
            'indovinello' => $this->indovinello,
            'punteggio' => $this->punteggio,
            'date' => $this->date,
        ];
    }
}
