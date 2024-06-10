<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Page;

class PageController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/pages');
    }

    public function index()
    {
        $pages = Page::all();
        return view('panel.pages.index', compact('pages'));
    }

    public function create(Page $pages)
    {
        return view('panel.pages.create', compact('pages'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Page::create($data);
        return redirect('/panel/pages')->with('success', 'با موفقیت افزوده شد!');
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
        // $message = $request->input('content');
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
        // $data['content'] = $dom->saveHTML();
        return $data;
    }

    public function edit($id)
    {
        $pages = Page::findOrFail($id);
        return view('panel.pages.edit', compact('pages'));
    }

    public function update(Request $request, $id)
    {
        $pages = Page::findOrFail($id);
        $data = $this->handleRequest($request);
        $pages->update($data);
        return redirect('/panel/pages')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $pages = Page::findOrFail($id);
        $pages->delete();
        return redirect('/panel/pages')->with('success', 'با موفقیت حذف شد!');
    }
}
