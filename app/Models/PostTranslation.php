<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostTranslation extends Model
{
    // 
    use HasFactory, SoftDeletes;
    protected $table = 'post_translate';
    protected $fillable = [
        'title',
        'lang_id',
        'post_id',
        'content',
    ];
    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

}
