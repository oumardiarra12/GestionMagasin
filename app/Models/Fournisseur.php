<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = ["NomFournisseur", "TelephoneFournisseur", "MobileFournisseur", "AdresseFournisseur", "EmailFournisseur", "RemarqueFournisseur"];
    public $timestamps = false;
    public function commandeachats()
    {
        return $this->hasMany(Commandeachat::class, "commandeachat_id", "id");
    }
}
