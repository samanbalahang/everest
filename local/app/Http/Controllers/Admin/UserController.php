<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\User;
use Auth;
use Hash;

class UserController extends AdminController
{
    public function index()
    {
        $user = Auth::user();
        return view('panel.user.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);
        return redirect('/panel/user')->with('success', 'با موفقیت بروزرسانی شد!');
    }
}