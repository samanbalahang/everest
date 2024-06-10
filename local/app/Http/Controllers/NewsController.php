<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(6);
        return view('site.news.index', compact('news'));
    }

    public function show($id, $title)
    {
        $news = News::findOrFail($id);
        $tit = str_replace("-", " ", $title);
        if ($news->title == $tit) {
            $views = $news->views + 1;
            $news->update([
                'views' =>  $views
            ]);
            return view('site.news.show', compact('news'));
        } else {
            return abort(404);
        }
    }
}
