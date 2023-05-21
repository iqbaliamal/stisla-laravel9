<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
  public function index()
  {
    $articles = Article::latest()->with('user')->get();

    return view('pages.home.index')->with([
      'articles' => $articles,
      'title' => 'Home'
    ]);
  }

  public function admin()
  {
    return view('pages.index');
  }

  public function detail($id)
  {
    $article = Article::findOrFail($id);

    return view('pages.home.detail', [
      'article' => $article->load('user'),
      'comments' => $article->comments()->with('article')->get(),
      'title' => 'Comments'
    ]);
  }

  /*Language Translation*/
  public function lang($locale)
  {
    // dd($locale);
    if ($locale) {
      App::setLocale($locale);
      Session::put('lang', $locale);
      Session::save();
      return redirect()->back()->with('locale', $locale);
    } else {
      return redirect()->back();
    }
  }
}
