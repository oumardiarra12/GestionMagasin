<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LivraisonResource extends JsonResource
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
            "NumLivraison" => $this->NumLivraison,
            "TotalLivraison" => $this->TotalLivraison,
            "DescriptionLivraison" => $this->DescriptionLivraison,
            "StatusLivraison" => $this->StatusLivraison,
            "commandeclient_id" => $this->commandeclient_id,
            'lignelivraison' => LignelivraisonResource::collection($this->lignelivraisons),
        ];
    }
}
