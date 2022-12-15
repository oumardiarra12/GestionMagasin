<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LignefactureclientResource extends JsonResource
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
            "Referencefcl" => $this->Referencefcl,
            "Designationfcl" => $this->Designationfcl,
            "PrixVentefcl" => $this->PrixVentefcl,
            "quantitefcl" => $this->quantitefcl,
            "soustotalfcl" => $this->soustotalfcl,
            "factureclient_id" => $this->factureclient_id,
            "article_id" => $this->article_id
        ];
    }
}
