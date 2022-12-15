<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignedevis extends Model
{
    use HasFactory;
    protected $fillable = ["ReferenceDevis","DesignationDevis","PrixVenteDevis","quantiteDevis","soustotalDevis","devis_id","article_id"];
    public $timestamps = false;
    public function article()
    {
        return $this->belongsTo(Article::class, "article_id", "id");
    }
    public function devis()
    {
        return $this->belongsTo(Devis::class, "devis_id", "id");
    }
}
