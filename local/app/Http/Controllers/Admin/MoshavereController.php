<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Moshavere;

class MoshavereController extends AdminController
{
    public function index()
    {
        $moshaveres = Moshavere::orderBy('created_at', 'DESC')->get();
        return view('panel.moshaveres.index', compact('moshaveres'));
    }

    public function destroy($id)
    {
        $m = Moshavere::find($id);
        $m->delete();
        return redirect()->route('admin.moshaveres.index')->with('success', 'با موفقیت حذف شد!');
    }
}