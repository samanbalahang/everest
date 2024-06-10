<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\DownloadCat;

class DownloadCatController extends AdminController
{
    public function index()
    {
        $downloadscat = DownloadCat::orderBy('created_at', 'desc')->get();
        return view('panel.downloadscat.index', compact('downloadscat'));
    }

    public function create(DownloadCat $downloadcat)
    {
        return view('panel.downloadscat.create', compact('downloadcat'));
    }

    public function store(Request $request)
    {
        DownloadCat::create($request->all());
        return redirect('/panel/downloadscat')->with('success', 'با موفقیت افزوده شد!');
    }

    public function edit($id)
    {
        $downloadcat = DownloadCat::findOrFail($id);
        return view('panel.downloadscat.edit', compact('downloadcat'));
    }

    public function update(Request $request, $id)
    {
        $downloadcat = DownloadCat::findOrFail($id);
        $downloadcat->update($request->all());
        return redirect('/panel/downloadscat')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $downloadcat = DownloadCat::findOrFail($id);
        $downloadcat->delete();
        return redirect('/panel/downloadscat')->with('success', 'با موفقیت حذف شد!');
    }
}
