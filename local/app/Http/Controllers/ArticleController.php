<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\ArticleCat;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        $cats = ArticleCat::all();
        $featured = Article::where('featured', 'yes')->orderBy('created_at', 'desc')->take(15)->get();
        return view('site.articles.index', compact('articles', 'cats', 'featured'));
    }

    public function show($id, $title)
    {
        $tit = str_replace("-", " ", $title);
        $article = Article::findOrFail($id);
        if ($article->title == $tit) {
            $views = $article->views + 1;
            $article->update([
                'views' =>  $views
            ]);
            $cats = ArticleCat::all();
            $featured = Article::where('featured', 'yes')->orderBy('created_at', 'desc')->take(15)->get();
            return view('site.articles.show', compact('article', 'cats', 'featured'));
        } else {
            return abort(404);
        }
    }

    public function category($slug)
    {
        $articleCat = ArticleCat::where('slug', $slug)->first();
        if ($articleCat) {
            $articles = Article::where('article_cat_id', $articleCat->id)->orderBy('created_at', 'desc')->paginate(5);
            $cats = ArticleCat::all();
            $featured = Article::where('featured', 'yes')->orderBy('created_at', 'desc')->take(15)->get();
            return view('site.articles.category', compact('articleCat', 'articles', 'cats', 'featured'));
        } else {
            return abort(404);
        }
    }
}
