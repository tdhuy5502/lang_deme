<?php

namespace App\Repositories\News;

use App\Models\News;
use Illuminate\Support\Facades\App;
use App\Repositories\BaseRepository;

class NewsRepository extends BaseRepository
{
    public function getModel()
    {
        return new News();
    }

    public function create($data)
    {
        $news = $this->save($data);
        $this->model = $news;

        return $news;
    }

    public function update($data)
    {
        $news = $this->save($data,$data['id']);
        $this->model = $news;

        return true;
    }

    public function getLatestNews($lang = 'vi')
    {
        $post = $this->getModel()->orderByDesc('created_at')->first();

        return $post ?  $this->mapTranslations(collect([$post]), $lang)
        ->first() : null;
    }

    public function getRelatedNews($lang = 'vi')
    {
        $posts = $this->getModel()->orderByDesc('created_at')
        ->take(2)->get();

        return $this->mapTranslations($posts, $lang);
    }

    public function getDifferentPost($id, $lang = 'vi')
    {
        $posts = $this->getModel()->orderByDesc('created_at')
        ->where('id', '!=', $id)->get();

        return $this->mapTranslations($posts, $lang);
    }

    public function getSidePosts($lang = 'vi')
    {
        $latestPost = $this->getLatestNews($lang);
        $posts = $this->getModel()->where('id', '!=', $latestPost['id'])
        ->take(4)->get();

        return $this->mapTranslations($posts, $lang);
    }

    protected function mapTranslations($newsCollection, $lang)
    {   
       
        return $newsCollection->map(function ($item) use ($lang) {
            return [
                'id' => $item->id,
                'title' => $lang == 'vi' ? $item->title_vi : ($lang == 'en' ? $item->title_en : $item->title_zh),
                'content' => $lang == 'vi' ? $item->content_vi : ($lang == 'en' ? $item->content_en : $item->content_zh),
            ];
        });
    }
}