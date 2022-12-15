<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommandeclientResource extends JsonResource
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
            "NumCommandeClient" => $this->NumCommandeClient,
            "TotalCommandeClient" => $this->TotalCommandeClient,
            "DescriptionCommandeClient" => $this->DescriptionCommandeClient,
            "StatusCommandeClient" => $this->StatusCommandeClient,
            "client_id" => $this->client_id,
            'lignecommandeclient' => LignecommandeclientResource::collection($this->lignecommandeclients),
        ];
    }
}
