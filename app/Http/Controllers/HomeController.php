<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
  public function index()
  {
    return view('pages.index')->with('title', 'Home');
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
