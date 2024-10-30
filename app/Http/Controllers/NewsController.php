<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\News;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Resources\PostResource;
use App\Models\Language;
use App\Repositories\News\NewsRepository;

class NewsController extends Controller
{
    //
    protected $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getData()
    {
        $posts = $this->newsRepository->getAll();

        return datatables()->of($posts)->make(true);
    }

    public function index()
    {
        return view('news.index');
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(StoreNewsRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $data = $request->all();
            $this->newsRepository->create($data);
            DB::commit();

            return redirect()->route('news.index');
        }
        catch(Exception $e)
        {
            Log::error($e);
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function show(Request $request)
    {
        $post = $this->newsRepository->getById($request->id);

        return view('news.edit')->with([
            'post' => $post
        ]);
    }

    public function update(UpdateNewsRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $data = $request->all();
            $this->newsRepository->update($data);
            DB::commit();

            return redirect()->route('news.index');
        }
        catch(Exception $e)
        {
            Log::error($e);
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $this->newsRepository->delete($request->id);
            DB::commit();

            return redirect()->route('news.index');
        }
        catch(Exception $e)
        {
            Log::error($e);
            DB::rollBack();
            return redirect()->back();
        }
    }


    public function createPost(Request $request)
    {
        $postData = Post::create(
            ['status' => $request['status']]);

        $english = Language::where('code','en')->first();
        $vietnamese = Language::where('code','vi')->first();

        $postData->translations()->create([
            'lang_id' => $english->id,
            'title' => $request['title_en'],
            'content' => $request['content_en']
        ]);

        $postData->translations()->create([
            'lang_id' => $vietnamese->id,
            'title' => $request['title_vi'],
            'content' => $request['content_vi']
        ]);

        $postList = new PostResource($postData);

        return response()->json($postList,200);
    }
}
