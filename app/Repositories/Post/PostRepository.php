<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    public function getModel()
    {
        return new Post();
    }

    
}