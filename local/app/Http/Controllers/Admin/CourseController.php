<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Course;

class CourseController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/courses');
    }

    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->get();
        return view('panel.courses.index', compact('courses'));
    }

    public function create(Course $course)
    {
        return view('panel.courses.create', compact('course'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Course::create($data);
        return redirect('/panel/courses')->with('success', 'با موفقیت افزوده شد!');
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
        // $desc = $request->input('desc');
        // $domDesc = new \DomDocument();
		// $domDesc->loadHtml(mb_convert_encoding($desc, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
		// $images = $domDesc->getElementsByTagName('img');
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
        // $data['desc'] = $domDesc->saveHTML();
        // $lessons = $request->input('lessons');
        // $domlessons = new \DomDocument();
		// $domlessons->loadHtml(mb_convert_encoding($lessons, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
		// $images = $domlessons->getElementsByTagName('img');
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
        // $data['lessons'] = $domlessons->saveHTML();
        // $works = $request->input('works');
        // $domworks = new \DomDocument();
		// $domworks->loadHtml(mb_convert_encoding($works, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
		// $images = $domworks->getElementsByTagName('img');
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
        // $data['works'] = $domworks->saveHTML();
        // $requires = $request->input('requires');
        // $domrequires = new \DomDocument();
		// $domrequires->loadHtml(mb_convert_encoding($requires, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
		// $images = $domrequires->getElementsByTagName('img');
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
        // $data['requires'] = $domrequires->saveHTML();
        return $data;
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('panel.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $data = $this->handleRequest($request);
        $course->update($data);
        return redirect('/panel/courses')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect('/panel/courses')->with('success', 'با موفقیت حذف شد!');
    }
}
