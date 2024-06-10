<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Lecturer;

class LecturerController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/lecturers');
    }

    public function index()
    {
        $lecturers = Lecturer::orderBy('created_at', 'desc')->get();
        return view('panel.lecturers.index', compact('lecturers'));
    }

    public function create(Lecturer $lecturer)
    {
        return view('panel.lecturers.create', compact('lecturer'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Lecturer::create($data);
        return redirect('/panel/lecturers')->with('success', 'با موفقیت افزوده شد!');
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
        $lecturer = Lecturer::findOrFail($id);
        return view('panel.lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, $id)
    {
        $lecturer = Lecturer::findOrFail($id);
        $data = $this->handleRequest($request);
        $lecturer->update($data);
        return redirect('/panel/lecturers')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $lecturer = Lecturer::findOrFail($id);
        $lecturer->delete();
        return redirect('/panel/lecturers')->with('success', 'با موفقیت حذف شد!');
    }
}
