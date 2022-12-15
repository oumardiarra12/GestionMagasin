<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LignereceptionResource extends JsonResource
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
            "ReferenceLigneRecept" => $this->ReferenceLigneRecept,
            "DesignationLigneRecept" => $this->DesignationLigneRecept,
            "PrixVenteLigneRecept" => $this->PrixVenteLigneRecept,
            "quantiteCMDLigneRecept" => $this->quantiteCMDLigneRecept,
            "quantiteLigneRecept" => $this->quantiteLigneRecept,
            "soustotalLigneRecept" => $this->soustotalLigneRecept,
            "reception_id" => $this->reception_id,
            "article_id" => $this->article_id,
        ];
    }
}
