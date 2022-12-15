<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LignelivraisonResource extends JsonResource
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
            "ReferenceLigneLivraison" => $this->ReferenceLigneLivraison,
            "DesignationLigneLivraison" => $this->DesignationLigneLivraison,
            "PrixVenteLigneLivraison" => $this->PrixVenteLigneLivraison,
            "quantiteLigneLivraison" => $this->quantiteLigneLivraison,
            "quantiteCMDCLLigneLivraison" => $this->quantiteCMDCLLigneLivraison,
            "soustotalLigneLivraison" => $this->soustotalLigneLivraison,
            "livraison_id" => $this->livraison_id,
            "article_id" => $this->article_id,
        ];
    }
}
