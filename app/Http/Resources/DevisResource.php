<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DevisResource extends JsonResource
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
            "NumDevis" => $this->NumDevis,
            "TotalDevis" => $this->TotalDevis,
            "RemisDevis" => $this->RemisDevis,
            "DescriptionDevis" => $this->DescriptionDevis,
            "StatusDevis" => $this->StatusDevis,
            "client_id" => $this->client_id,
            'lignedevis' => LignedevisResource::collection($this->lignedevis),

        ];
    }
}
