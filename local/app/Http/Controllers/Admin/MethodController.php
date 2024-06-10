<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Method;

class MethodController extends AdminController
{
    public function index()
    {
        $methods = Method::orderBy('created_at', 'desc')->get();
        return view('panel.methods.index', compact('methods'));
    }

    public function create(Method $method)
    {
        return view('panel.methods.create', compact('method'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Method::create($data);
        return redirect('/panel/methods')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        return $data;
    }

    public function edit($id)
    {
        $method = Method::findOrFail($id);
        return view('panel.methods.edit', compact('method'));
    }

    public function update(Request $request, $id)
    {
        $method = Method::findOrFail($id);
        $data = $this->handleRequest($request);
        $method->update($data);
        return redirect('/panel/methods')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $method = Method::findOrFail($id);
        $method->delete();
        return redirect('/panel/methods')->with('success', 'با موفقیت حذف شد!');
    }
}
