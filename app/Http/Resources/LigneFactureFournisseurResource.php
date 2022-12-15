<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LigneFactureFournisseurResource extends JsonResource
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
            'id'=>$this->id,
            'ReferenceLigneFacture'=>$this->ReferenceLigneFacture,
            'DesignationLigneFacture'=>$this->DesignationLigneFacture,
            'PrixAchatLigneFacture'=>$this->PrixAchatLigneFacture,
            'quantiteLigneFacture'=>$this->quantiteLigneFacture,
            'soustotalLigneFacture'=>$this->soustotalLigneFacture,
            'facturefournisseur_id'=>$this->facturefournisseur_id,
            'article_id'=>$this->article_id,

        ];
    }
}
