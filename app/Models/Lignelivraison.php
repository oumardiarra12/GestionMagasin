<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignelivraison extends Model
{
    use HasFactory;
    protected $fillable = ["ReferenceLigneLivraison","DesignationLigneLivraison","PrixVenteLigneLivraison","quantiteLigneLivraison","quantiteCMDCLLigneLivraison","soustotalLigneLivraison","livraison_id","article_id"];
    public function article()
    {
        return $this->belongsTo(Article::class, "article_id", "id");
    }
    public function livraison()
    {
        return $this->belongsTo(Livraison::class, "livraison_id", "id");
    }
}
