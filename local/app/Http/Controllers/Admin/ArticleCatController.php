<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\ArticleCat;

class ArticleCatController extends AdminController
{
    public function index()
    {
        $articlescat = ArticleCat::orderBy('created_at', 'desc')->get();
        return view('panel.articlescat.index', compact('articlescat'));
    }

    public function create(ArticleCat $articlecat)
    {
        return view('panel.articlescat.create', compact('articlecat'));
    }

    public function store(Request $request)
    {
        ArticleCat::create($request->all());
        return redirect('/panel/articlescat')->with('success', 'با موفقیت افزوده شد!');
    }

    public function edit($id)
    {
        $articlecat = ArticleCat::findOrFail($id);
        return view('panel.articlescat.edit', compact('articlecat'));
    }

    public function update(Request $request, $id)
    {
        $articlecat = ArticleCat::findOrFail($id);
        $articlecat->update($request->all());
        return redirect('/panel/articlescat')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $articlecat = ArticleCat::findOrFail($id);
        $articlecat->delete();
        return redirect('/panel/articlescat')->with('success', 'با موفقیت حذف شد!');
    }
}
