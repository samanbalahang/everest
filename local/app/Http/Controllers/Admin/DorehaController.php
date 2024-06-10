<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Doreha;

class DorehaController extends AdminController
{
    public function index()
    {   
        $doreha = Doreha::orderBy('created_at', 'desc')->get();
        return view('panel.doreha.index', compact('doreha'));

    }

    public function create(Doreha $doreha)
    {
        return view('panel.doreha.create',compact("doreha"));
    }
    public function store(Request $request)
    {
        $oldDoreh =  Doreha::where("title",trim($request->title))->first();
        if($oldDoreh == null){
            $data = $request->all();
            Doreha::create($data);
            return redirect()->route("admin.doreha.index")->with('success', 'با موفقیت افزوده شد!');
        }else{
            return redirect()->route("admin.doreha.index")->with('success', 'دوره تکراری است!');
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
        $doreha = Doreha::findOrFail($id);
        return view('panel.doreha.edit', compact('doreha'));
    }
    public function update(Request $request, $id)
    {
        //
        $doreha = Doreha::findOrFail($id);
        $data = $request->all();
        $doreha->update($data);
        return redirect()->route("admin.doreha.index")->with('success', 'با موفقیت بروزرسانی شد!');
    }
    public function destroy($id)
    {
        //
        $doreha = Doreha::findOrFail($id);
        $doreha->delete();
        return redirect()->route("admin.doreha.index")->with('success', 'با موفقیت حذف شد!');
    }
}
