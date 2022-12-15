<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'ReferenceArticle'=>$this->ReferenceArticle,
            'CodeBarre'=>$this->CodeBarre,
            'NomArticle'=>$this->NomArticle,
            'ImageArticle'=>$this->ImageArticle,
            'PrixAchat'=>$this->PrixAchat,
            'PrixVente'=>$this->PrixVente,
            'StockActuel'=>$this->StockActuel,
            'StockMin'=>$this->StockMin,
            'DescriptionArticle'=>$this->DescriptionArticle,
            'categorie_id'=>$this->categorie_id,
            'unite_id'=>$this->unite_id,
        ];
    }
}
