<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommandeachatResource extends JsonResource
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
            "NumCommandeAchat"=>$this->NumCommandeAchat,
            "TotalCommandeAchat"=>$this->TotalCommandeAchat,
            "DescriptionCommandeAchat"=>$this->DescriptionCommandeAchat,
            "StatusCommandeAchat"=>$this->StatusCommandeAchat,
            "fournisseur_id"=>$this->fournisseur_id,
            'lignecommandeachat' => LigneCommandeachatResource::collection($this->lignecommandeachats),


        ];
    }
}
