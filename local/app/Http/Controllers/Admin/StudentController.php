<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\StudentW;

class StudentController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/students');
    }

    public function index()
    {
        $students = StudentW::orderBy('created_at', 'desc')->get();
        return view('panel.students.index', compact('students'));
    }

    public function create(StudentW $student)
    {
        return view('panel.students.create', compact('student'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        StudentW::create($data);
        return redirect('/panel/students')->with('success', 'با موفقیت افزوده شد!');
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
        $student = StudentW::findOrFail($id);
        return view('panel.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = StudentW::findOrFail($id);
        $data = $this->handleRequest($request);
        $student->update($data);
        return redirect('/panel/students')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $student = StudentW::findOrFail($id);
        $student->delete();
        return redirect('/panel/students')->with('success', 'با موفقیت حذف شد!');
    }
}
