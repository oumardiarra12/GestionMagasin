<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factureclient extends Model
{
    use HasFactory;
    protected $fillable = ["NumFactureClient", "TotalFactureClient", "DescriptionFactureClient", "StatusFactureClient", "livraison_id"];
    public function livraison()
    {
        return $this->belongsTo(Livraison::class, "livraison_id", "id");
    }
    public function lignefactures()
    {
        return $this->hasMany(Lignefacture::class, "factureclient_id", "id");
    }
    public function reglementclients()
    {
        return $this->hasMany(ReglementClient::class, "factureclient_id", "id");
    }
}
