<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = ["NumDevis", "TotalDevis", "RemisDevis", "DescriptionDevis", "StatusDevis", "client_id"];
    public function client()
    {
        return $this->belongsTo(Client::class, "client_id", "id");
    }
    public function lignedevis()
    {
        return $this->hasMany(Lignedevis::class, "devis_id", "id");
    }
}
