<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Job;
use App\JobCat;
use App\Course;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'desc')->paginate(8);
        $features = Job::where('featured', 'yes')->get();
        $featured = collect([]);
        foreach ($features as $ft) {
            if (! $ft->expired) {
                $featured->push($ft);
            }
        }
        $courses = Course::orderBy('created_at', 'desc')->take(10)->get();
        $cats = JobCat::all();
        return view('site.jobs.index', compact('jobs', 'featured', 'courses', 'cats'));
    }

    public function show($id)
    {
        $job = Job::findOrFail($id);
        $views = $job->views + 1;
        $job->update([
            'views' => $views
        ]);
        $similar = $job->jobCat->jobs->where('id', '!=', $id)->take(5);
        $courses = Course::orderBy('created_at', 'desc')->take(10)->get();
        $cats = JobCat::all();
        return view('site.jobs.show', compact('job', 'similar', 'courses', 'cats'));
    }

    public function category($slug)
    {
        $cat = JobCat::where('slug', $slug)->first();
        if ($cat) {
            $views = $cat->views + 1;
            $cat->update([
                'views' => $views
            ]);
            $jobs = Job::where('job_cat_id', $cat->id)->orderBy('created_at', 'desc')->paginate(8);
            $courses = Course::orderBy('created_at', 'desc')->take(10)->get();
            $cats = JobCat::all();
            return view('site.jobs.category', compact('cat', 'jobs', 'courses', 'cats'));
        } else {
            return abort(404);
        }
    }
}
