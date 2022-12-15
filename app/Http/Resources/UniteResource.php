<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UniteResource extends JsonResource
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
            "NomUnite"=>$this->NomUnite,
            "CodeUnite"=>$this->CodeUnite,
            "DescriptionUnite"=>$this->DescriptionUnite,
        ];
    }
}
