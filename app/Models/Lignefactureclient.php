<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignefactureclient extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["Referencefcl","Designationfcl","PrixVentefcl","quantitefcl","soustotalfcl","factureclient_id","article_id"];
    public function article()
    {
        return $this->belongsTo(Article::class, "article_id", "id");
    }
    public function factureclient()
    {
        return $this->belongsTo(Factureclient::class, "facture_id", "id");
    }
}
