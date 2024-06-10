<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Department;

class DepartmentController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/departments');
    }

    public function index()
    {
        $departments = Department::orderBy('created_at', 'desc')->get();
        return view('panel.departments.index', compact('departments'));
    }

    public function create(Department $department)
    {
        return view('panel.departments.create', compact('department'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Department::create($data);
        return redirect('/panel/departments')->with('success', 'با موفقیت افزوده شد!');
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
        $department = Department::findOrFail($id);
        return view('panel.departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $data = $this->handleRequest($request);
        $department->update($data);
        return redirect('/panel/departments')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect('/panel/departments')->with('success', 'با موفقیت حذف شد!');
    }
}
