<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\OldCourse;

class OldCourseController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/oldcourses');
    }

    public function index()
    {
        $oldcourses = OldCourse::orderBy('created_at', 'desc')->get();
        return view('panel.oldcourses.index', compact('oldcourses'));
    }

    public function create(OldCourse $oldcourse)
    {
        return view('panel.oldcourses.create', compact('oldcourse'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        OldCourse::create($data);
        return redirect('/panel/oldcourses')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('image1')) {
            $image = $request->file('image1');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image1'] = $fileName;
        }
        if ($request->hasFile('image2')) {
            $image = $request->file('image2');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image2'] = $fileName;
        }
        if ($request->hasFile('image3')) {
            $image = $request->file('image3');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image3'] = $fileName;
        }
        if ($request->hasFile('image4')) {
            $image = $request->file('image4');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image4'] = $fileName;
        }
        if ($request->hasFile('image5')) {
            $image = $request->file('image5');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image5'] = $fileName;
        }
        if ($request->hasFile('image6')) {
            $image = $request->file('image6');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image6'] = $fileName;
        }
        if ($request->hasFile('image7')) {
            $image = $request->file('image7');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image7'] = $fileName;
        }
        if ($request->hasFile('image8')) {
            $image = $request->file('image8');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image8'] = $fileName;
        }
        if ($request->hasFile('image9')) {
            $image = $request->file('image9');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image9'] = $fileName;
        }
        if ($request->hasFile('image10')) {
            $image = $request->file('image10');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image10'] = $fileName;
        }
        return $data;
    }

    public function edit($id)
    {
        $oldcourse = OldCourse::findOrFail($id);
        return view('panel.oldcourses.edit', compact('oldcourse'));
    }

    public function update(Request $request, $id)
    {
        $oldcourse = OldCourse::findOrFail($id);
        $data = $this->handleRequest($request);
        $oldcourse->update($data);
        return redirect('/panel/oldcourses')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $oldcourse = OldCourse::findOrFail($id);
        $oldcourse->delete();
        return redirect('/panel/oldcourses')->with('success', 'با موفقیت حذف شد!');
    }
}
