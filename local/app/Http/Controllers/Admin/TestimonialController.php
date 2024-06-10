<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Testimonial;

class TestimonialController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/videos');
    }

    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('panel.testimonials.index', compact('testimonials'));
    }

    public function create(Testimonial $testimonial)
    {
        return view('panel.testimonials.create', compact('testimonial'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Testimonial::create($data);
        return redirect('/panel/testimonials')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $fileName = $video->getClientOriginalName();
            $destination = $this->uploadPath;
            $video->move($destination, $fileName);
            $data['video'] = $fileName;
        }
        return $data;
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('panel.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $data = $this->handleRequest($request);
        $testimonial->update($data);
        return redirect('/panel/testimonials')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return redirect('/panel/testimonials')->with('success', 'با موفقیت حذف شد!');
    }
}
