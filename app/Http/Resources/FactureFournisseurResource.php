<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FactureFournisseurResource extends JsonResource
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
            'NumFactures'=>$this->NumFactures,
            'TotalFacture'=>$this->TotalFacture,
            'DescriptionFacture'=>$this->DescriptionFacture,
            'StatusFacture'=>$this->StatusFacture,
            'reception_id'=>$this->reception_id,
            'lignefacturefournisseur' => LigneFactureFournisseurResource::collection($this->lignefacturefournisseur),
        ];
    }
}
