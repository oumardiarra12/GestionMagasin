<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignereception extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["ReferenceLigneRecept", "DesignationLigneRecept", "PrixVenteLigneRecept", "quantiteLigneRecept", "soustotalLigneRecept", "reception_id", "article_id"];
    public function article()
    {
        return $this->belongsTo(Article::class, "article_id", "id");
    }
    public function reception()
    {
        return $this->belongsTo(Reception::class, "reception_id", "id");
    }
}
