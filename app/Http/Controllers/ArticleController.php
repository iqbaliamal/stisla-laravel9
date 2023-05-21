<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->with('user')->get();

        return view('pages.article.index', [
            'articles' => $articles,
            'title' => 'Articles'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3',
        ]);

        if ($request->path != null) {
            $path = $request->path;
            $filename = explode('/', $path);

            $directory = explode('/', $path);
            array_pop($directory);
            $directory = implode('/', $directory);

            if (!File::exists(public_path('images/post'))) {
                File::makeDirectory(public_path('images/post'), 0777, true, true);
            }

            File::move(storage_path('app/' . $path), public_path('images/post/' . $filename[3]));
            File::deleteDirectory(storage_path('app/' . $directory));

            $urlpostFile = url('images/post/' . $filename[3]);
        };

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $urlpostFile ?? null,
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Article created successfully",
        ]);
    }

    public function show(Article $article)
    {
        return view('pages.comment.index', [
            'article' => $article->load('user'),
            'comments' => $article->comments()->with('article')->get(),
            'title' => 'Comments'
        ]);
    }

    public function edit(Article $article)
    {
        return response()->json([
            "status" => "success",
            "data" => $article
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:3',
        ]);

        if ($request->path != null) {
            $path = $request->path;
            $filename = explode('/', $path);

            $directory = explode('/', $path);
            array_pop($directory);
            $directory = implode('/', $directory);

            if (!File::exists(public_path('images/post'))) {
                File::makeDirectory(public_path('images/post'), 0777, true, true);
            }

            File::move(storage_path('app/' . $path), public_path('images/post/' . $filename[3]));
            File::deleteDirectory(storage_path('app/' . $directory));

            $urlpostFile = url('images/post/' . $filename[3]);
        };

        if ($article->image != null) {
            $post = explode('/', $article->image);
            File::delete(public_path('images/post/' . $post[3]));
        }

        $article->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $urlpostFile ?? null,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "Article updated successfully",
        ]);
    }

    public function destroy(Article $article)
    {
        if ($article->image != null) {
            $post = explode('/', $article->image);
            File::delete(public_path('images/post/' . $post[3]));
        }

        $article->delete();

        return response()->json([
            "status" => "success",
            "message" => "Article deleted successfully",
        ]);
    }
}
