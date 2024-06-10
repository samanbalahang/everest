<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Number;

class NumberController extends Controller
{
    public function index()
    {
        $numbers = Number::all();
        return view('panel.numbers.index', compact('numbers'));
    }

    public function store(Request $request)
    {
        foreach($request->all() as $key => $value) {
            if ($key != '_token' && $key != '_method') {
                $num = Number::where('name', $key)->first();
                $num->update(['number' => $value]);
            }
        }
        return redirect('/panel/numbers')->with('success', 'با موفقیت ذخیره شد!');
    }
}
