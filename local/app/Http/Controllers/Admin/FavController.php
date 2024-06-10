<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Fav;

class FavController extends AdminController
{
    public function index()
    {
        $favs = Fav::orderBy('created_at', 'desc')->get();
        return view('panel.favs.index', compact('favs'));
    }

    public function create(Fav $fav)
    {
        return view('panel.favs.create', compact('fav'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Fav::create($data);
        return redirect('/panel/favs')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        return $data;
    }

    public function edit($id)
    {
        $fav = Fav::findOrFail($id);
        return view('panel.favs.edit', compact('fav'));
    }

    public function update(Request $request, $id)
    {
        $fav = Fav::findOrFail($id);
        $data = $this->handleRequest($request);
        $fav->update($data);
        return redirect('/panel/favs')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $fav = Fav::findOrFail($id);
        $fav->delete();
        return redirect('/panel/favs')->with('success', 'با موفقیت حذف شد!');
    }
}
