<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReglementclientResource extends JsonResource
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
            "ReferenceRegCl" => $this->ReferenceRegCl,
            "MontantAPayerRegCl" => $this->MontantAPayerRegCl,
            "MontantPayerRgCl" => $this->MontantPayerRgCl,
            "MontantRestant" => $this->MontantRestant,
            "factureclient_id" => $this->factureclient_id
        ];
    }
}
