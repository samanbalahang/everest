<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;
use App\Course;
use App\Download;
use App\Job;
use App\News;
use App\OldCourse;

class SearchController extends Controller
{
    public function search()
    {
        $keyword = $_GET['keyword'];
        $articles = Article::where('title','LIKE','%'.$keyword.'%')
            ->orWhere('content','LIKE','%'.$keyword.'%')
            ->get();
        $courses = Course::where('title','LIKE','%'.$keyword.'%')
            ->orWhere('desc','LIKE','%'.$keyword.'%')
            ->orWhere('lessons','LIKE','%'.$keyword.'%')
            ->orWhere('works','LIKE','%'.$keyword.'%')
            ->orWhere('requires','LIKE','%'.$keyword.'%')
            ->orWhere('title_en','LIKE','%'.$keyword.'%')
            ->orWhere('company','LIKE','%'.$keyword.'%')
            ->get();
        $downloads = Download::where('title', 'LIKE', '%'.$keyword.'%')
            ->orWhere('desc','LIKE','%'.$keyword.'%')
            ->get();
        $jobs = Job::where('title','LIKE','%'.$keyword.'%')
            ->orWhere('content','LIKE','%'.$keyword.'%')
            ->get();
        $news = News::where('title','LIKE','%'.$keyword.'%')
            ->orWhere('content','LIKE','%'.$keyword.'%')
            ->get();
        $count = $articles->count() + $courses->count() + $downloads->count() + $jobs->count() + $news->count();
        return view('site.search', compact('articles', 'courses', 'downloads', 'jobs', 'news', 'keyword', 'count'));
    }
}
