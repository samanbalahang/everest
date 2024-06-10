<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Slider;

class SliderController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/sliders');
    }

    public function index()
    {
        $sliders = Slider::orderBy('created_at', 'desc')->get();
        return view('panel.sliders.index', compact('sliders'));
    }

    public function create(Slider $slider)
    {
        return view('panel.sliders.create', compact('slider'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Slider::create($data);
        return redirect('/panel/sliders')->with('success', 'با موفقیت افزوده شد!');
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
        $slider = Slider::findOrFail($id);
        return view('panel.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $this->handleRequest($request);
        $slider->update($data);
        return redirect('/panel/sliders')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect('/panel/sliders')->with('success', 'با موفقیت حذف شد!');
    }
}
