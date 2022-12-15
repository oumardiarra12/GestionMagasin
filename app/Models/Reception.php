<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;
    protected $fillable = ["NumRecept", "TotalRecept", "DescriptionRecept", "StatusReception", "commandeachat_id"];
    public function commandeachat()
    {
        return $this->belongsTo(Commandeachat::class, "commandeachat_id", "id");
    }
    public function lignereceptions()
    {
        return $this->hasMany(Lignereception::class, 'reception_id', 'id');
    }
}
