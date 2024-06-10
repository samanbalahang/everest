<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use App\Sarnakh;

class sarnakhController extends AdminController
{
    public function index()
    {
        $sarnakh = Sarnakh::orderBy('created_at', 'desc')->get();
        return view('panel.sarnakh.index', compact('sarnakh'));
    }

    public function create(Sarnakh $sarnakh)
    {
        return view('panel.sarnakh.create',compact("sarnakh"));

    }

    public function store(Request $request)
    {
        $oldSarnakh =  Sarnakh::where("title",trim($request->title))->first();
        if($oldSarnakh == null){
            $data = $request->all();
            Sarnakh::create($data);
            return redirect()->route("admin.sarnakh.index")->with('success', 'با موفقیت افزوده شد!');
        }else{
            return redirect()->route("admin.sarnakh.index")->with('success', 'نحوه آشنایی تکراری است!');
        }
    }
    public function handleRequest($request)
    {
        $data = $request->all();
        return $data;
    }

    public function edit($id)
    {
        $sarnakh = Sarnakh::findOrFail($id);
        return view('panel.sarnakh.edit', compact('sarnakh'));
    }

    public function update(Request $request, $id)
    {
        $sarnakh = Sarnakh::findOrFail($id);
        $data = $request->all();
        $sarnakh->update($data);
        return redirect()->route("admin.sarnakh.index")->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $sarnakh = Sarnakh::findOrFail($id);
        $sarnakh->delete();
        return redirect()->route("admin.sarnakh.index")->with('success', 'با موفقیت حذف شد!');
    }
}
