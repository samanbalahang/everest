<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Message;

class MessageController extends AdminController
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('panel.messages.index', compact('messages'));
    }
    
    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->update([
            'seen' => '1'
        ]);
        return view('panel.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect('/panel/messages')->with('success', 'با موفقیت حذف شد!');
    }
}
