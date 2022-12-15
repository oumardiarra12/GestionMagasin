<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FactureclientResource extends JsonResource
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
            "NumFactureClient" => $this->NumFactureClient,
            "TotalFactureClient" => $this->TotalFactureClient,
            "DescriptionFactureClient" => $this->DescriptionFactureClient,
            "StatusFactureClient" => $this->StatusFactureClient,
            "livraison_id" => $this->livraison_id,
            "lignefactureclients" => LignefactureclientResource::collection($this->lignefactureclients),
        ];
    }
}
