<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Menu;
use App\MenuPos;

class MenuController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/menus');
    }

    public function index()
    {
        $menu = Menu::where('parent_id', 0)->get();
        return view('panel.menu.index', compact('menu'));
    }

    public function create(Menu $menu)
    {
        return view('panel.menu.create', compact('menu'));
    }
    
    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Menu::create($data);
        return redirect('/panel/menu')->with('success', 'با موفقیت افزوده شد!');
    }
    
    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image'] = $fileName;
        }
        if ($request->input('parent_id') == NULL) {
            $data['parent_id'] = 0;
        }
        return $data;
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('panel.menu.edit', compact('menu'));
    }
    
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $data = $this->handleRequest($request);
        $menu->update($data);
        return redirect('/panel/menu')->with('success', 'با موفقیت بروزرسانی شد!');
    }
    
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->subs) {
            foreach ($menu->subs as $sub) {
                $sub->delete();
            }
            $menu->delete();
            $success = 'منو و زیرمنوها با موفقیت حذف شدند!';
        } else {
            $menu->delete();
            $success = 'با موفقیت حذف شد!';
        }
        return redirect('/panel/menu')->with('success', $success);
    }
}
