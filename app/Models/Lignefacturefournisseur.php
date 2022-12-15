<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignefacturefournisseur extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["ReferenceLigneFacture","DesignationLigneFacture","PrixAchatLigneFacture","quantiteLigneFacture","soustotalLigneFacture","facturefournisseur_id","article_id"];
    public function article()
    {
        return $this->belongsTo(Article::class, "article_id", "id");
    }
    public function facturefournisseur()
    {
        return $this->belongsTo(Facturefournisseur::class, "facturefournisseur_id", "id");
    }
}
