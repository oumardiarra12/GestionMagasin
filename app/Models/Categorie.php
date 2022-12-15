<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = ["NomCategorie", "DesCategorie"];
    public $timestamps = false;
    public function articles()
    {
        return $this->hasMany(Article::class, "article_id", "id");
    }
}
