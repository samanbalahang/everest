<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page) {
            return view('site.page', compact('page'));
        } else {
            return abort(404);
        }
    }
}
