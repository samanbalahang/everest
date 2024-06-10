<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\OldCourse;

class OldCourseController extends Controller
{
    public function index()
    {
        $courses = OldCourse::orderBy('created_at', 'desc')->paginate(8);
        return view('site.oldcourses.index', compact('courses'));
    }
    
    public function search()
    {
        $keyword = $_GET['keyword'];
        $department = intval($_GET['department']);
        $year = $_GET['year'];
        if ($department == "" && $year == "") {
            $result = OldCourse::where('title','LIKE','%'.$keyword.'%')->get();
            // echo "Key";
        } elseif ($keyword == "" && $year == "") {
            $result = OldCourse::where('department_id', $department)->get();
            // echo "Dep";
        } elseif ($keyword == "" && $department == "") {
            $result = OldCourse::where('start_year', $year)->get();
            // echo "Yea";
        } elseif ($year == "") {
            $result = OldCourse::where([
                    ['department_id', 'LIKE', $department],
                    ['title','LIKE','%'.$keyword.'%']
                ])->get();
            // echo "Dep-Key";
        } elseif ($department == "") {
            $result = OldCourse::where([
                    ['title','LIKE','%'.$keyword.'%'],
                    ['start_year', 'LIKE', $year]
                ])->get();
            // echo "Yea-Key";
        } elseif ($keyword == "") {
            $result = OldCourse::where([
                    ['start_year', 'LIKE', $year],
                    ['department_id', 'LIKE', $department]
                ])->get();
            // echo "Yea-Dep";
        } else {
            $result = OldCourse::where([
                    ['title','LIKE','%'.$keyword.'%'],
                    ['department_id', 'LIKE', $department],
                    ['start_year', 'LIKE', $year]
                ])->get();
            // echo "Yea-Dep-Key";
        }
        return view('site.oldcourses.search', compact('result'));
    }
}
