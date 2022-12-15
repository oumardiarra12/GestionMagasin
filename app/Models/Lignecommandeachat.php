<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignecommandeachat extends Model
{
    use HasFactory;
    protected $fillable = ["Referencecmdf","Designationcmdf","PrixAchatcmdf","quantitecmdf","soustotalcmdf","commandeachat_id","article_id"];
    public $timestamps = false;
    public function article()
    {
        return $this->belongsTo(Article::class, "article_id", "id");
    }
    public function commandeachat()
    {
        return $this->belongsTo(Commandeachat::class, "commandeachat_id", "id");
    }

}
