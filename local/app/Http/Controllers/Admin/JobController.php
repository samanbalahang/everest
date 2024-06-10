<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Job;

class JobController extends AdminController
{
    
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->get();
        return view('panel.jobs.index', compact('jobs'));
    }

    public function create(Job $job)
    {
        return view('panel.jobs.create', compact('job'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Job::create($data);
        return redirect('/panel/jobs')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
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
        $job = Job::findOrFail($id);
        return view('panel.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $data = $this->handleRequest($request);
        $job->update($data);
        return redirect('/panel/jobs')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect('/panel/jobs')->with('success', 'با موفقیت حذف شد!');
    }
}
