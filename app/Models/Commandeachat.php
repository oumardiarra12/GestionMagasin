<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandeachat extends Model
{
    use HasFactory;
    protected $fillable = ["id", "NumCommandeAchat", "TotalCommandeAchat", "DescriptionCommandeAchat", "StatusCommandeAchat", "fournisseur_id"];
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class, "fournisseur_id", "id");
    }
    public function lignecommandeachats()
    {
        return $this->hasMany(Lignecommandeachat::class, "commandeachat_id", "id");
    }
}
