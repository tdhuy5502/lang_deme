<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Post extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'status'
    ];

    public function translations()
    {
        return $this->hasMany(PostTranslation::class);        
    }

    public function translate($langId)
    {
        return $this->translations->where('lang_id', $langId)->first();
    }
}
