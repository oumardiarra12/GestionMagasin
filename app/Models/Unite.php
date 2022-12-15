<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unite extends Model
{
    use HasFactory;
    protected $fillable = ["id", "CodeUnite", "NomUnite", "DescriptionUnite"];
    public $timestamps = false;
    public function articles()
    {
        return $this->hasMany(Article::class, "article_id", "id");
    }
}
