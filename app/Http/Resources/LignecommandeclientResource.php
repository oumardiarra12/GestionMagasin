<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LignecommandeclientResource extends JsonResource
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
            "Referencecmdc" => $this->Referencecmdc,
            "Designationcmdc" => $this->Designationcmdc,
            "PrixAchatcmdc" => $this->PrixAchatcmdc,
            "quantitecmdc" => $this->quantitecmdc,
            "soustotalcmdc" => $this->soustotalcmdc,
            "commandeclient_id" => $this->commandeclient_id,
            "article_id" => $this->article_id,
        ];
    }
}
