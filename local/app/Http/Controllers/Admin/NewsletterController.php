<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Advice;

class NewsletterController extends AdminController
{
    public function index()
    {
        $newsletters = Advice::orderBy('created_at', 'desc')->get();
        return view('panel.newsletters.index', compact('newsletters'));
    }

    public function destroy($id)
    {
        $newsletter = Advice::findOrFail($id);
        $newsletter->delete();
        return redirect('/panel/newsletters')->with('success', 'با موفقیت حذف شد!');
    }
}
