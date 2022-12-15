<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglementfournisseur extends Model
{
    use HasFactory;
    protected $fillable = ["ReferenceRegF","MontantAPayerRegF","MontantPayerRgF","MontantRestant","facturefournisseur_id"];
    public function facturefournisseur()
    {
        return $this->belongsTo(Facturefournisseur::class, "facturefournisseur_id", "id");
    }
}
