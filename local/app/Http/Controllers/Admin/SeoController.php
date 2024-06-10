<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Seo;

class SeoController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/seo');
    }

    public function index()
    {
        $seo = Seo::all();
        return view('panel.seo.index', compact('seo'));
    }

    public function create(Seo $seo)
    {
        return view('panel.seo.create', compact('seo'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Seo::create($data);
        return redirect('/panel/seo')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image'] = $fileName;
        }
        return $data;
    }

    public function edit($id)
    {
        $seo = Seo::findOrFail($id);
        return view('panel.seo.edit', compact('seo'));
    }

    public function update(Request $request, $id)
    {
        $seo = Seo::findOrFail($id);
        $data = $this->handleRequest($request);
        $seo->update($data);
        return redirect('/panel/seo')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $seo = Seo::findOrFail($id);
        $seo->delete();
        return redirect('/panel/seo')->with('success', 'با موفقیت حذف شد!');
    }
}
