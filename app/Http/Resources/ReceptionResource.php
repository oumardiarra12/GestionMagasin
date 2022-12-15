<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceptionResource extends JsonResource
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
            "NumRecept"=>$this->NumRecept,
            "TotalRecept"=>$this->TotalRecept,
            "DescriptionRecept"=>$this->DescriptionRecept,
            "StatusReception"=>$this->StatusReception,
            "commandeachat_id"=>$this->commandeachat_id,
            'lignereception' => LignereceptionResource::collection($this->lignereceptions),
        ];
    }
}
