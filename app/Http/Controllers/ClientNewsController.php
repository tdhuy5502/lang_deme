<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\News\NewsRepository;

class ClientNewsController extends Controller
{
    //
    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    

    public function index(Request $request)
    {
        $lang = $request->get('lang','vi');

        $latestNews = $this->newsRepository->getLatestNews($lang);
        $relatedNews = $this->newsRepository->getRelatedNews($lang);
        $differentPosts = $this->newsRepository->getDifferentPost($latestNews['id'], $lang);
        $sidePosts = $this->newsRepository->getSidePosts($lang);


        $this->langChange($lang);
       
        return view('main.index')->with([
            'latestNews' => $latestNews,
            'relatedNews' => $relatedNews,
            'differentPosts' => $differentPosts,
            'sidePosts' => $sidePosts,
            'lang' => $lang
        ]);
    }

    public function langChange($lang){
        
        if(!in_array($lang,['vi','en','zh']))
        {
            return new Exception('language not found');
        }
        
        session(['lang' => $lang]);
        return redirect()->route('top-news.index');
    }

    public function show(Request $request)
    {
        $lang = $request->get('lang','vi');
        
        $latestNews = $this->newsRepository->getLatestNews($lang);
        
        $differentPosts = $this->newsRepository->getDifferentPost($latestNews['id'], $lang);
        $post = $this->newsRepository->getById($request->id);
        
        return view('main.details')->with([
            'post' => $post,
            'differencePosts' => $differentPosts
        ]);
    }
}
