<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'news';

    protected $fillable = [
        'slug',

        'title_en', 
        'content_en', 

        'title_vi',
        'content_vi', 
        
        'title_zh', 
        'content_zh'
    ];
}
