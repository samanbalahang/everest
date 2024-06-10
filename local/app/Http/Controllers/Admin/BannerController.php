<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Banner;
use Image;

class BannerController extends AdminController
{
    public function index()
    {
        $banner = Banner::all();
        return view('panel.banner.index', compact('banner'));
    }

    public function create(Banner $banner)
    {
        return view('panel.banner.create', compact('banner'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Banner::create($data);
        return redirect('/panel/banner')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        // $message = $request->input('desc');
        // $dom = new \DomDocument();
		// $dom->loadHtml(mb_convert_encoding($message, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
		// $images = $dom->getElementsByTagName('img');
		// foreach($images as $img){
		// 	$src = $img->getAttribute('src');
		// 	if(preg_match('/data:image/', $src)){
		// 		preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
		// 		$mimetype = $groups['mime'];
		// 		$filename = uniqid();
		// 		$filepath = "/storage/images/$filename.$mimetype";
		// 		$image = Image::make($src)
		// 		  ->encode($mimetype, 100)
		// 		  ->save(public_path($filepath));
				
		// 		$new_src = asset($filepath);
		// 		$img->removeAttribute('src');
		// 		$img->setAttribute('src', $new_src);
		// 	}
        // }
        // $data['desc'] = $dom->saveHTML();
        return $data;
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('panel.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $data = $this->handleRequest($request);
        $banner->update($data);
        return redirect('/panel/banner')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return redirect('/panel/banner')->with('success', 'با موفقیت حذف شد!');
    }
}
