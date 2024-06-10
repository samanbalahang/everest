<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Download;

class DownloadController extends AdminController
{
    protected $uploadPath;
    protected $filePath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/downloads');
        $this->filePath = public_path('storage/files/downloads');
    }

    public function index()
    {
        $downloads = Download::orderBy('created_at', 'desc')->get();
        return view('panel.downloads.index', compact('downloads'));
    }

    public function create(Download $download)
    {
        return view('panel.downloads.create', compact('download'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Download::create($data);
        return redirect('/panel/downloads')->with('success', 'با موفقیت افزوده شد!');
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
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $destination = $this->filePath;
            $file->move($destination, $fileName);
            $data['file'] = $fileName;
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
        $download = Download::findOrFail($id);
        return view('panel.downloads.edit', compact('download'));
    }

    public function update(Request $request, $id)
    {
        $download = Download::findOrFail($id);
        $data = $this->handleRequest($request);
        $download->update($data);
        return redirect('/panel/downloads')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $download = Download::findOrFail($id);
        $download->delete();
        return redirect('/panel/downloads')->with('success', 'با موفقیت حذف شد!');
    }
}
