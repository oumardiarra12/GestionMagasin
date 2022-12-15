<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commandeclient extends Model
{
    use HasFactory;
    protected $fillable = ["NumCommandeClient", "TotalCommandeClient", "DescriptionCommandeClient", "StatusCommandeClient", "client_id"];
    public function client()
    {
        return $this->belongsTo(Client::class, "client_id", "id");
    }
    public function lignecommandeclients()
    {
        return $this->hasMany(Lignecommandeclient::class, "commandeclient_id", " id");
    }
    public function livraisons()
    {
        return $this->hasMany(Livraison::class, "livraison_id", "id");
    }
}
