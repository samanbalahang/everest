<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\DB;
use App\Kaebaran;
use App\Area;
use App\Signal;
use App\UserSignal;

class KarbaranController extends AdminController
{
    protected $uploadPath;
    public function index()
    {
        if(Kaebaran::exists()){
            $karbaran  = Kaebaran::all();
            return view('panel.Karbaran.index',compact("karbaran"));
        }else{
            return view('panel.Karbaran.index');
        }    
    }

    public function create()
    {
        return view('panel.Karbaran.create');
    }

    public function store(Request $request)
    {
        $a = $request;
        $a["password"] = md5($request->password);
        $data = $this->handleRequest($a);
        Kaebaran::create($data);
        return redirect()->route("admin.karbaran.index")->with('success', 'با موفقیت افزوده شد!');
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
        return $data;
    }
    public function edit($id)
    {
        $karbaran = Kaebaran::findOrFail($id);
        return view('panel.Karbaran.edit', compact('karbaran'));
    }

    public function update(Request $request, $id)
    {
        $karbaran = Kaebaran::findOrFail($id);
        $a = $request;
        $a["password"] = md5($request->password);
        $data = $this->handleRequest($a);
        $karbaran->update($data);
        return redirect()->route("admin.karbaran.index")->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $karbaran = Kaebaran::findOrFail($id);
        $karbaran->delete();
        return redirect()->back()->with('success', 'با موفقیت حذف شد!');
    }

    public function oldKarbar(Request $request){
        $karbaran = Kaebaran::where("karbar_phone",$request->mobile)->first();
        if($karbaran != null){
            return $karbaran;
        }else{
            return "";
        }
    }

    public function arealist(){
        $areas = Area::where("state_id",31)->where("city_id",31)->get();
        return view('panel.Karbaran.arealist',compact("areas"));
    }

    public function jsonarealist(Request $request){
        $state_id = $request->state_id;
        $city_id = $request->city_id;
        
        $areas = Area::where("state_id",$state_id)->where("city_id",$city_id)->get();
        return json_encode($areas, JSON_UNESCAPED_UNICODE );
    }

    public function areacreate(Request $request)
    {
        $data =  $request->all();
        Area::create($data);
        return redirect()->back()->with('success', 'با موفقیت افزوده شد!');
    }
    public function areaupdate(Request $request, $id)
    {
        if($request->area == ""){
            if($this->areadelete($id)){
                return redirect()->route("admin.area.list")->with('success', 'با موفقیت حذف شد!');
            }
        }else{
            $karbaran = Area::findOrFail($id);
            $data = $request->all();
            $karbaran->update($data);
            return redirect()->back()->with('success', 'با موفقیت بروزرسانی شد!');
        }
    }
    public function areadelete($id)
    {
        $karbaran = Area::findOrFail($id);
        if($karbaran->delete()){
            return true;
        }
       
    }
    public function signallist(){
        // $signals = Signal::all();
        // $users   = UserSignal::orderBy('created_at', 'desc')->get();
         // return view("panel.signal.list",compact("signals","users"));
        // $users= DB::table('usersignal')->orderBy('usersignal'.'created_at', 'desc')
        //                 ->join('signals', 'usersignal.id', '=', 'signals.user_signal_id')
        //                 ->leftJoin('signalmoshaver', 'usersignal.id', '=', 'signalmoshaver.user_signal_id')
        //                 ->select('usersignal.id as usersignalId','usersignal.created_at as usersignalcreated_at','usersignal.*','signals.request as signalsrequest','signals.id as signalid', 'signals.*', 'signalmoshaver.created_at as signalmoshavercreated_at', 'signalmoshaver.updated_at as signalmoshaverupdated_at','signalmoshaver.*')
        //                 ->get();
        $users= DB::table('usersignal')->orderBy('usersignal'.'created_at', 'desc')
         ->join('signals', 'usersignal.id', '=', 'signals.user_signal_id')
         ->select('usersignal.id as usersignalId','usersignal.created_at as usersignalcreated_at','usersignal.*','signals.request as signalsrequest','signals.id as signalid', 'signals.*')
         ->get();
        return view("panel.signal.list",compact("users"));
    }
    public function signalliststore(Request $request)
    {
        Signal::create($request->all());
        return redirect()->route("admin.karbaran.index")->with('success', 'با موفقیت افزوده شد!');
    }

    public function signallistedit($id)
    {
        $signal = Signal::findOrFail($id);
        return view('panel.Karbaran.edit', compact('signal'));
    }



    public function signallistupdate(Request $request, $id)
    {
        $signal = Signal::findOrFail($id);
        $data = $this->handleRequest($request);
        $signal->update($data);
        return redirect()->back()->with('success', 'با موفقیت بروزرسانی شد!');
    }
    public function signallistdelete($id)
    {
        
        $UserSignal =UserSignal::findOrFail($id);
        if($UserSignal){
            $karbaran = Signal::where("user_signal_id",$id)->get();
            $varna="test";
            $i = 1;
            $test = "test";
            $$varna.$i;
            foreach($karbaran as $karbar){
                $i++;
                $$varna.$i = Signal::find($karbar->id);
                $$varna.$i->delete();
            }

        }
        $UserSignal->delete();
        return redirect()->route("admin.signal.list")->with('success', 'با موفقیت حذف شد!');
    }
}