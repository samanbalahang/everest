<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Ashnaee;

class ashnaeeController extends AdminController
{
    public function index()
    {
        $ashnaee = Ashnaee::orderBy('created_at', 'desc')->get();
        return view('panel.ashnaee.index', compact('ashnaee'));
    }

    public function create(Ashnaee $ashnaee)
    {
        return view('panel.ashnaee.create',compact("ashnaee"));

    }

    public function store(Request $request)
    {
        $oldAshnaee =  Ashnaee::where("title",trim($request->title))->first();
        if($oldAshnaee == null){
            $data = $request->all();
            Ashnaee::create($data);
            return redirect()->route("admin.ashnaee.index")->with('success', 'با موفقیت افزوده شد!');
        }else{
            return redirect()->route("admin.ashnaee.index")->with('success', 'نحوه آشنایی تکراری است!');
        }
    }
    public function handleRequest($request)
    {
        $data = $request->all();
        return $data;
    }

    public function edit($id)
    {
        $ashnaee = Ashnaee::findOrFail($id);
        return view('panel.ashnaee.edit', compact('ashnaee'));
    }

    public function update(Request $request, $id)
    {
        $ashnaee = Ashnaee::findOrFail($id);
        $data = $request->all();
        $ashnaee->update($data);
        return redirect()->route("admin.ashnaee.index")->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $ashnaee = Ashnaee::findOrFail($id);
        $ashnaee->delete();
        return redirect()->route("admin.ashnaee.index")->with('success', 'با موفقیت حذف شد!');
    }

}
