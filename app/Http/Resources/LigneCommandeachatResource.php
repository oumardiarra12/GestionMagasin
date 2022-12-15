<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LigneCommandeachatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            "Referencecmdf"=>$this->Referencecmdf,
            "Designationcmdf"=>$this->Designationcmdf,
            "PrixAchatcmdf"=>$this->PrixAchatcmdf,
            "quantitecmdf"=>$this->quantitecmdf,
            "soustotalcmdf"=>$this->soustotalcmdf,
            "commandeachat_id"=>$this->commandeachat_id,
            "article_id"=>$this->article_id,
        ];
    }
}
