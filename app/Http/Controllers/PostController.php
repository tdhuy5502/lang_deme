<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Language;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    //
    public function index()
    {
        return view('news.index');
    }

    public function create()
    {
        $languages= Language::all();
        return view('news.create')->with([
            'languages' => $languages
        ]);
    }  

    public function store(StorePostRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $data = $request->validated();
            $post = Post::create(['status' => $data['status']]);
            foreach ($data['translations'] as $translation) {
                $post->translations()->create([
                    'lang_id' => $translation['lang_id'],
                    'title' => $translation['title'],
                    'content' => $translation['content'],
                ]);
            }
            DB::commit();

            $postData = new PostResource($post);
            return response()->json($postData,200);
        }
        catch(Exception $e)
        {
            Log::error($e);
            DB::rollBack();
            return response()->json($e,500);
        }
    }

    public function show(Request $request)
    {
        $post = Post::with('translations')->findOrFail($request->id);
        // dd($post->translations);
        return view('news.edit')->with([
            'post' => $post
        ]);
    }

    public function update(StorePostRequest $request, $id)
    {
        try
        {
            DB::beginTransaction();
            
            $post = Post::findOrFail($id);
            $data = $request->validated();
            
            $post->status = $data['status'];
            $post->save();
            $post->translations()->delete();

            foreach ($data['translations'] as $translation) {
                $post->translations()->create([
                    'lang_id' => $translation['lang_id'],
                    'title' => $translation['title'],
                    'content' => $translation['content'],
                ]);
            }
            DB::commit();

            return redirect()->route('posts.index');
        }
        catch(Exception $e)
        {
            Log::error($e);
            DB::rollBack();
            return response()->json($e, 500);
        }
    }

    public function delete()
    {

    }
}
