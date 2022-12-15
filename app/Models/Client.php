<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ["NomClient","EmailClient","TelephoneClient","MobileClient","AdresseClient","RemarqueClient"];
    public $timestamps = false;
    public function commandeclients()
    {
        return $this->hasMany(CommandeClient::class);
    }
    public function devis()
    {
        return $this->hasMany(Devis::class);
    }
}
