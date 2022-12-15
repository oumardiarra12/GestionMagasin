<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FournisseurResource extends JsonResource
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
            "id"=>$this->id,
            'NomFournisseur'=>$this->NomFournisseur,
            'TelephoneFournisseur'=>$this->TelephoneFournisseur,
            'MobileFournisseur'=>$this->MobileFournisseur,
            'AdresseFournisseur'=>$this->AdresseFournisseur,
            'EmailFournisseur'=>$this->EmailFournisseur,
            'RemarqueFournisseur'=>$this->RemarqueFournisseur,
        ];
    }
}
