<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReglementFournisseurResource extends JsonResource
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
            'ReferenceRegF'=>$this->ReferenceRegF,
            'MontantAPayerRegF'=>$this->MontantAPayerRegF,
            'MontantPayerRgF'=>$this->MontantPayerRgF,
            'MontantRestant'=>$this->MontantRestant,
            'facturefournisseur_id'=>$this->facturefournisseur_id,
        ];
    }
}
