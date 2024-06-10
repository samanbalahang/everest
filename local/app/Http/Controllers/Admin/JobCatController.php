<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\JobCat;

class JobCatController extends AdminController
{
    public function index()
    {
        $jobscat = JobCat::orderBy('created_at', 'desc')->get();
        return view('panel.jobscat.index', compact('jobscat'));
    }

    public function create(JobCat $jobcat)
    {
        return view('panel.jobscat.create', compact('jobcat'));
    }

    public function store(Request $request)
    {
        JobCat::create($request->all());
        return redirect('/panel/jobscat')->with('success', 'با موفقیت افزوده شد!');
    }

    public function edit($id)
    {
        $jobcat = JobCat::findOrFail($id);
        return view('panel.jobscat.edit', compact('jobcat'));
    }

    public function update(Request $request, $id)
    {
        $jobcat = JobCat::findOrFail($id);
        $jobcat->update($request->all());
        return redirect('/panel/jobscat')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $jobcat = JobCat::findOrFail($id);
        $jobcat->delete();
        return redirect('/panel/jobscat')->with('success', 'با موفقیت حذف شد!');
    }
}
