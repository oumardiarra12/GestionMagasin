<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    protected $fillable = ["NumLivraison", "TotalLivraison", "DescriptionLivraison", "StatusLivraison", "commandeclient_id"];
    public function commandeclient()
    {
        return $this->belongsTo(Commandeclient::class, "commandeclient_id", "id");
    }
    public function lignelivraisons()
    {
        return $this->hasMany(Livraison::class, "livraison_id", "id");
    }
}
