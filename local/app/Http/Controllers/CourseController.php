<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\Department;

class CourseController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $search = "";
        return view('site.courses.index', compact('departments', 'search'));
    }

    public function all()
    {
        $departments = Department::all();
        $search = "";
        return view('site.courses.all', compact('departments', 'search'));
    }

    public function search()
    {
        $keyword = $_GET['keyword'];
        $search = "";
        $departments = Department::all();
        $result = Course::where('title','LIKE','%'.$keyword.'%')
                ->orWhere('desc','LIKE','%'.$keyword.'%')
                ->orWhere('lessons','LIKE','%'.$keyword.'%')
                ->orWhere('works','LIKE','%'.$keyword.'%')
                ->orWhere('requires','LIKE','%'.$keyword.'%')
                ->orWhere('title_en','LIKE','%'.$keyword.'%')
                ->orWhere('company','LIKE','%'.$keyword.'%')
                ->get();
        return view('site.courses.search', compact('result', 'departments', 'search'));
    }

    public function department($slug)
    {
        $department = Department::where('slug', $slug)->first();
        $search = "";
        if ($department) {
            $courses = $department->courses;
            return view('site.courses.department', compact('department', 'courses', 'search'));
        } else {
            return abort(404);
        }
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->first();
        if ($course) {
            $num = $course->views + 1;
            $course->update([
                'views' => $num
            ]);
            $depid = $course->department->id;
            $courses = Department::find($depid)->courses->where('id', '!=', $course->id);
            $jobs = Department::find($depid)->jobs;
            return view('site.courses.show', compact('course', 'courses', 'jobs'));
        } else {
            return abort(404);
        }
    }
}
