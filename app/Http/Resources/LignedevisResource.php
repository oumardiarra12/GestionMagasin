<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LignedevisResource extends JsonResource
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
            "ReferenceDevis" => $this->ReferenceDevis,
            "DesignationDevis" => $this->DesignationDevis,
            "PrixVenteDevis" => $this->PrixVenteDevis,
            "quantiteDevis" => $this->quantiteDevis,
            "soustotalDevis" => $this->soustotalDevis,
            "devis_id" => $this->devis_id,
            "article_id" => $this->article_id,
        ];
    }
}
