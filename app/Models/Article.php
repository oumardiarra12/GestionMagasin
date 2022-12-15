<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ["ReferenceArticle","CodeBarre","NomArticle","ImageArticle","PrixAchat","PrixVente","StockActuel","StockMin","DescriptionArticle",'categorie_id','unite_id'];
    public $timestamps = false;
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, "categorie_id", "id");
    }
    public function unite()
    {
        return $this->belongsTo(Unite::class, "Unite_id", "id");
    }
}
