<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturefournisseur extends Model
{
    use HasFactory;
    protected $fillable = ["NumFactures", "TotalFacture", "DescriptionFacture", "StatusFacture", "reception_id"];
    public function reception()
    {
        return $this->belongsTo(Reception::class, "reception_id", "id");
    }
    public function lignefacturefournisseur()
    {
        return $this->hasMany(Lignefacturefournisseur::class, "facturefournisseur_id", "id");
    }
    public function reglementfournisseurs()
    {
        return $this->hasMany(Reglementfournisseur::class, "facturefournisseur_id", "id");
    }
}
