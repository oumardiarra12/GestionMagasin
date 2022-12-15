<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglementclient extends Model
{
    use HasFactory;
    protected $fillable = ["ReferenceRegCl","MontantAPayerRegCl","MontantPayerRgCl","MontantRestant","factureclient_id"];
    public function facture()
    {
        return $this->belongsTo(Factureclient::class, "factureclient_id", "id");
    }
}
