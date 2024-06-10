<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $students = \App\StudentW::all()->count();
        $news = \App\News::all()->count();
        $articles = \App\Article::all()->count();
        $downloads = \App\Download::all()->count();
        $courses = \App\Course::all()->count();
        $olds = \App\OldCourse::all()->count();
        $lecturers = \App\Lecturer::all()->count();
        $jobs = \App\Job::all()->count();
        return view('panel.dashboard', compact('students', 'news', 'articles', 'downloads', 'courses', 'olds', 'lecturers', 'jobs'));
    }
}
