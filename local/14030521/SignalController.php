<?php

namespace App\Http\Controllers;
session_start();
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Kaebaran;
use App\Area;
use App\Course;
use App\Doreha;
use App\UserSignal;
use App\Signal;
use App\signalmoshaver;
use App\Ashnaee;
use App\Sarnakh;
use Carbon\Carbon;

class SignalController extends Controller
{
    public function karbaran()
    {
        // LOGUT
        if (isset($_GET["newuser"]) &&  $_GET["newuser"] == 1) {
            setcookie("phone", "", time() - 3600);
            setcookie("password", "", time() - 3600);
            unset($_GET["newuser"]);
        }
        return view("site.karbaran.login");
    }

    public function hashedcookie($thehash){
        $cookie_name = "thehash";
        $cookie_value = $thehash;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30)); // 86400 = 1 day

    }

    public function setsession($user,$thehash){
        $_SESSION["karbar_id"]      = $user->id;
        $_SESSION["karbar_name"]    = $user->karbar_name;
        $_SESSION["karbar_lname"]   = $user->karbar_lname;
        $_SESSION["karbar_phone"]   = $user->karbar_phone;
        $_SESSION["karbar_role"]    = $user->karbar_role;
        $_SESSION["karbar_active"]  = $user->active;
        $_SESSION["thehash"]        = $thehash;
    }

    // لاگین در سایت
    public function cheked(Request $request)
    {

        $Karbaran = new Kaebaran;
        $phone    = $request->karbar_phone;
        $password = md5($request->password);
        $thiskarbar = $Karbaran::where("karbar_phone", $phone)->where("password", $password)->first();
        if ($thiskarbar != null) {
            $thehash = md5($thiskarbar->id.$thiskarbar->karbar_phone);
            $this->hashedcookie($thehash);
            $this->setsession($thiskarbar,$thehash);
            return redirect()->route("site.signal.create");
        }else{
            return redirect()->back()->with('message', 'کاربر یافت نشد.');
        }
    }

    public function checkcooke()
    {
        if(!isset($_COOKIE["thehash"]) || (!isset($_SESSION["thehash"]))){
            return false;
        }else{
            $cookieHash  = $_COOKIE["thehash"];
            $sessionHash = $_SESSION["thehash"];
            if ($cookieHash == $sessionHash){
                return $_SESSION;
            }
            else{
                return false;  
            }
        }
        // if (!isset($_COOKIE["phone"])) {
        //     return false;
        // } elseif (!isset($_COOKIE["password"])) {
        //     return false;
        // } else {
        //     $phone    = $_COOKIE["phone"];
        //     $password = $_COOKIE["password"];
        //     $correctpass = intval($password) / 53;
        //     $thisuser  = Kaebaran::where("karbar_phone", $phone)->where("password", $correctpass)->where("active", 1)->first();
        //     if ($thisuser != null) {
        //         return $thisuser;
        //     }
        // }
    }

    // ایجاد سیگنال
    public function create()
    {
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
            $areas = Area::where("state_id", 31)->where("city_id", 31)->get();
            $courses = Doreha::all();
            $ashnaee = Ashnaee::all();
            $sarenakh = Sarnakh::all();
            return view("site.signal.create", compact("areas", "courses", "ashnaee","sarenakh", "karbaran"));
        } else {
            return redirect()->route("site.signal.login");
        }
    }

    public function jsonarealist(Request $request)
    {
        $state_id = $request->state_id;
        $city_id = $request->city_id;

        $areas = Area::where("state_id", $state_id)->where("city_id", $city_id)->get();
        return json_encode($areas, JSON_UNESCAPED_UNICODE);
    }


    // ثبت کاربر سیگنال
    public function signal(Request $request)
    {
        $a = $request;
        $data = $request->all();
        $data["course_id"]=$request->course_id[0];
        if (!isset($request->olduser)) {
            $user = new UserSignal;
            $signal = new Signal;
      
            $UserSignal = UserSignal::create($data);
            $a["user_signal_id"] = $UserSignal->id;
            $this->redSig($a);
        } else {
            $thisuser  = UserSignal::find($request->olduser);
            $UserSignal = $thisuser->update($data);
            $a["user_signal_id"] = $request->olduser;
            $this->redSig($a);
        }
        // $user->method_id    = $request->method_id;
        // $user->course_id    = $request->course_id;
        // $user->fname        = $request->fname;
        // $user->lname        = $request->lname;
        // $user->mobile       = $request->mobile;
        // $user->mellicode    = $request->mellicode;
        // $user->tozihat      = $request->tozihat;
        // $user->Age          = $request->Age;
        // $user->gender       = $request->gender;
        // $user->field        = $request->field;
        // $user->fieldLevel   = $request->fieldLevel;
        // $user->state        = $request->state;
        // $user->city         = $request->city;
        // $user->area         = $request->area;
        // $user->lead	        = $request->lead;
        // $user->request      = $request->request;
        // $user->sava();


        // $signal->user_signal_id = $user->id;
        // $signal->course_id      = $request->course_id;
        // $signal->request        = $request->request;
        // $signal->save();
        return redirect()->back()->with('message', 'ثبت با موفقیت انجام شده است.');
    }

    // ثبت خود سیگنال فانکشن بالا برای کاربران سیگنال است.
    public function redSig(Request $request)
    {
     
        if(is_array($request->course_id)){
            if(count($request->course_id)>1){
                $courses = $request->course_id;
                foreach ($courses as $course) {
                    $oldsignal = Signal::where("user_signal_id", $request->user_signal_id)->where("course_id",$course)->first();
                    if (!$oldsignal) {
                        $data = $request->all();
                        $data["course_id"]=$course;
                        Signal::create($data);
                    }
                    else {
                        $data = $request->all();
                        $data["course_id"]=$course;
                        $oldsignal->update($data);
                    } 
                }
            }else{
           
                $data = $request->all();
                $data["course_id"]=$request->course_id[0];
                $course_id = strval($data["course_id"]);
                
                $oldsignal = Signal::where("user_signal_id", $request->user_signal_id)->where("course_id", $course_id)->first();
                if (!$oldsignal) {
                    // dd($data);
                    Signal::create($data);
                }
                else {
                    $oldsignal->update($data);
                }
            }
        }else{
            $oldsignal = Signal::where("user_signal_id", $request->user_signal_id)->where("course_id", $request->course_id)->first();
            if (!$oldsignal) {
                $data = $request->all();
                Signal::create($data);
            }
            else {
                $data = $request->all();
                $oldsignal->update($data);
            }
        }
    }

    public function list()
    {
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
            $users= DB::table('usersignal')->orderBy('usersignal'.'created_at', 'desc')
            ->join('signals', 'usersignal.id', '=', 'signals.user_signal_id')
            ->leftJoin('signalmoshaver', 'usersignal.id', '=', 'signalmoshaver.user_signal_id')
            ->select('usersignal.id as usersignalId','usersignal.karbar_id as usersignalKarbar','usersignal.created_at as usersignalcreated_at','usersignal.*','signals.request as signalsrequest','signals.id as signalid', 'signals.*', 
                        'signalmoshaver.id as moshaverID'
                        ,'signalmoshaver.karbar_id as moshaverKarbar',
                        'signalmoshaver.created_at as signalmoshavercreated_at', 'signalmoshaver.updated_at as signalmoshaverupdated_at','signalmoshaver.*')
                        ->get();
            $users = $users->unique('signalid');
            if($users->count()<= 0){
                $users= DB::table('usersignal')
                ->join('signals', 'usersignal.id', '=', 'signals.user_signal_id')
                ->select('usersignal.id as usersignalId','usersignal.*', 'signals.*')
                ->get();
           }                     
            return view("site.signal.list", compact("users", "karbaran"));
        } else {
            return redirect()->route("site.signal.login");
        }
    }
    public function moshaver($id)
    {
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
            $user     = UserSignal::find($id);
            $signals  = Signal::where("user_signal_id", $id)->get();
            return view("site.signal.moshavereh", compact("user", "signals", "karbaran"));
        } else {
            return redirect()->route("site.signal.login");
        }
    }
    public function sabtmoshaver(Request $request)
    {
        $data = $request->all();
        $oldMoshavereh  = signalmoshaver::where("signal_id",$request->signal_id)->where("user_signal_id",$request->user_signal_id)->first();
        if($oldMoshavereh == null){
            $signalmoshaver = signalmoshaver::create($data);
            return redirect()->back();
        }else{
            $oldMoshavereh->update($data);
            return redirect()->back();
        }
    }

    public function olduser(Request $request)
    {
        $useer = UserSignal::where("mobile", $request->mobile)->first();
        if ($useer != null) {
            return  $useer;
        } else {
            return "";
        }
    }

    public function oldsignals(Request $request)
    {
        //    dd('$request->id: '. $request->id); 
        $thesignals = Signal::where("user_signal_id", $request->id)->get();
        $signals = [];
        if ($thesignals->count() > 0) {
            foreach ($thesignals as $thesignal) {
                $thesignal["course"] = Doreha::find($thesignal->course_id)->title;
                array_push($signals, $thesignal);
            }

            //   foreach ($signals as $signal) {
            //     $end[] = 
            //   }  
            return json_encode($signals, JSON_UNESCAPED_UNICODE);
        } else {
            return "";
        }
    }

    public function amar()
    {
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
            $male         =  UserSignal::where("gender", 1)->get();
            $maleCount    =  $male->count();
            $female       =  UserSignal::where("gender", 0)->get();
            $femaleCount  =  $female->count();
            $areaList     =  Area::All();
            $theareas      =  [];
            $areanames    =  [];
            foreach ($areaList as $area) {
                $theareas[] =  UserSignal::orderBy('area', 'asc')->where("area", $area->id)->get()->count();
                $areanames[] =$area->area; 
            }
            $doreha       =  Doreha::all();
            $dorehaName   = [];
            $signals      =  Signal::orderBy('user_signal_id', 'asc')->get();
            $todaySignal  = Signal::whereDate('created_at', Carbon::today())->get()->count();
            $kolMoshavereha = signalmoshaver::all()->count();
            $todayMoshavereh = signalmoshaver::whereDate('created_at', Carbon::today())->get()->count();
            $bedoneNatigeh = signalmoshaver::where("vazeiat","بدون نتیجه")->get()->count();
            $sabtenameKard = signalmoshaver::where("vazeiat","ثبت نام کرد")->get()->count();
            $garareBiad = signalmoshaver::where("vazeiat","قرار بیاید")->get()->count();
            $monSaferShood = signalmoshaver::where("vazeiat","منصرف شد")->get()->count();
            $darhaleBarresi = signalmoshaver::where("vazeiat","در حال بررسی")->get()->count();
            $kolKarban         =  UserSignal::all()->count();
            $kolSignal         =  Signal::all()->count();
            $kolSignalkarbarans = DB::table('signals')
                 ->select('signals.user_signal_id', DB::raw('count(*) as total'))
                 ->groupBy('signals.user_signal_id')
                 ->get();
            $signaldore   =  [];
            $signaldors    = [];
            foreach ($doreha as $doreh) {
                $signaldors[] = Signal::where("course_id", $doreh->id)->get()->count();
                $dorehaName[] = $doreh->title;
            }
            // foreach ($signaldors as $signaldorew) {
            //     $signaldore[$doreh->title][] = $signaldorew->count();
            // }
            $ashnaee      = Ashnaee::all();
            $sarnakh      = Sarnakh::all();
            $ashnaeearray = [];
            $methodNames  = [];
            foreach ($ashnaee as $method) {
                $lists = UserSignal::orderBy('method_id', 'asc')->where("method_id", $method->id)->get()->count();
                $ashnaeearray[]= $lists;
                $methodNames[] = $method->title;
            }
            $lead      = [];
            foreach ($sarnakh as $method) {
                $lists = UserSignal::orderBy('lead', 'asc')->where("lead", $method->id)->get()->count();
                $lead[] = $lists;
            }

            // dd($karbaran->karbar_name);
            if($maleCount > 0){
            $malePercent  = intval($maleCount) * 100 / intval($kolKarban);
            }else{
                $malePercent =0;
            }
            if($femaleCount>0){
            $femalePercent= intval($femaleCount) * 100 / intval($kolKarban);
            }else{
                $femalePercent = 0;
            }

            return view("site.signal.amar", compact("karbaran", "malePercent", "femalePercent","areanames", "areaList", "theareas","dorehaName", "doreha","signaldors", "signals", "kolKarban", "kolSignal", "ashnaee","methodNames", "ashnaeearray", "lead","todaySignal","kolMoshavereha","todayMoshavereh","bedoneNatigeh","sabtenameKard","garareBiad","monSaferShood","darhaleBarresi","kolSignalkarbarans"));
        } else {
            return redirect()->route("site.signal.login");
        }
    }
    public function amarkarbaran()
    {
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
            $kolSignal = Signal::all()->count();
            $allkarbaran  = Kaebaran::all();
            $table = [];
            $i=0;
            foreach ($allkarbaran  as $karbar) {
               $table[$i]["lname"]=$karbar->karbar_lname;
               $table[$i]["UserSignal"]=UserSignal::where("karbar_id",$karbar->id)->get()->count();
               $table[$i]["signal"]=Signal::where("karbar_id",$karbar->id)->get()->count();
               $table[$i]["moshavereh"]=signalmoshaver::where("karbar_id",$karbar->id)->get()->count();
               $table[$i]["moshavereh"]=signalmoshaver::where("karbar_id",$karbar->id)->get()->count();
               $table[$i]["vazeiatBedon"]=signalmoshaver::where("karbar_id",$karbar->id)->where("vazeiat","بدون نتیجه")->get()->count();
               $table[$i]["vazeiatGarar"]=signalmoshaver::where("karbar_id",$karbar->id)->where("vazeiat","قرار بیاید")->get()->count();
               $table[$i]["vazeiatMonsaref"]=signalmoshaver::where("karbar_id",$karbar->id)->where("vazeiat","منصرف شد")->get()->count();
               $table[$i]["vazeiatDarha"]=signalmoshaver::where("karbar_id",$karbar->id)->where("vazeiat","در حال بررسی")->get()->count();
               $table[$i]["vazeiatSabt"]=signalmoshaver::where("karbar_id",$karbar->id)->where("vazeiat","ثبت نام کرد")->get()->count();
               $i++;
            }   
            return view("site.signal.amarKarbaran", compact("karbaran","kolSignal","allkarbaran","table"));
        } else {
            return redirect()->route("site.signal.login");
        }
    }

    public function ajaxMoshaver(Request $request){
        $moshaver = signalmoshaver::find($request->id);
        if($moshaver){
            return json_encode($moshaver, JSON_UNESCAPED_UNICODE); 
        }else{
            return  "";
        }

    }
    public function singleDate(Request $request){
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
        }
        $singleDate = $request->singleDate;
        $curentDate   = date("y-m-d",$singleDate);
        $kolSignal  = Signal::whereDate('updated_at', $curentDate)->count();
        $carbontoday = \Carbon\Carbon::today();
        $allkarbaran  = Kaebaran::all();
        $time         = time();
        $testdate     = date("y-m-d",$time);
        $testdate     = date("y-m-d",$time);
        $table = [];
        $i=0;
        foreach ($allkarbaran  as $karbar) {
           $table[$i]["lname"]=$karbar->karbar_lname;
           $table[$i]["UserSignal"]=UserSignal::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["signal"]=Signal::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["moshavereh"]=signalmoshaver::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["moshavereh"]=signalmoshaver::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["vazeiatBedon"]=signalmoshaver::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->where("vazeiat","بدون نتیجه")->get()->count();
           $table[$i]["vazeiatGarar"]=signalmoshaver::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->where("vazeiat","قرار بیاید")->get()->count();
           $table[$i]["vazeiatMonsaref"]=signalmoshaver::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->where("vazeiat","منصرف شد")->get()->count();
           $table[$i]["vazeiatDarha"]=signalmoshaver::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->where("vazeiat","در حال بررسی")->get()->count();
           $table[$i]["vazeiatSabt"]=signalmoshaver::whereDate('updated_at', $curentDate)->where("karbar_id",$karbar->id)->where("vazeiat","ثبت نام کرد")->get()->count();
           $i++;
        }   
        $data = [$singleDate,$carbontoday,$curentDate,$testdate,$karbaran,$kolSignal,$allkarbaran,$table];
        return json_encode($data , JSON_UNESCAPED_UNICODE); 
    }
    public function singleDateFromto(Request $request){
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
        }
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $from   = date("y-m-d",$fromDate);
        $to     = date("y-m-d",$toDate);
        $kolSignal  = Signal::whereBetween('updated_at', [$from,$to])->count();
        $carbontoday = \Carbon\Carbon::today();
        $allkarbaran  = Kaebaran::all();
        $time         = time();
        $testdate     = date("y-m-d",$time);
        $testdate     = date("y-m-d",$time);
        $table = [];
        $i=0;
        foreach ($allkarbaran  as $karbar) {
           $table[$i]["lname"]=$karbar->karbar_lname;
           $table[$i]["UserSignal"]=UserSignal::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["signal"]=Signal::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["moshavereh"]=signalmoshaver::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["moshavereh"]=signalmoshaver::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->get()->count();
           $table[$i]["vazeiatBedon"]=signalmoshaver::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->where("vazeiat","بدون نتیجه")->get()->count();
           $table[$i]["vazeiatGarar"]=signalmoshaver::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->where("vazeiat","قرار بیاید")->get()->count();
           $table[$i]["vazeiatMonsaref"]=signalmoshaver::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->where("vazeiat","منصرف شد")->get()->count();
           $table[$i]["vazeiatDarha"]=signalmoshaver::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->where("vazeiat","در حال بررسی")->get()->count();
           $table[$i]["vazeiatSabt"]=signalmoshaver::whereBetween('updated_at', [$from,$to])->where("karbar_id",$karbar->id)->where("vazeiat","ثبت نام کرد")->get()->count();
           $i++;
        }   
        $data = [$fromDate,$carbontoday,$to,$testdate,$karbaran,$kolSignal,$allkarbaran,$table];
        return json_encode($data , JSON_UNESCAPED_UNICODE); 
    }


    // شماره تلفن کاربران برای سامانه پیام کوتاه
    public function phoneNumbers(){
        $karbaran =$this->checkcooke();
        if ($karbaran) {
            $karbaran =(object) $karbaran;
            $karbaran->id = $karbaran->karbar_id;
            $karbaran->active = $karbaran->karbar_active;
            $users = UserSignal::all();
            $textfile=[];
            foreach ($users as $user ) {
                $textfile[]= intval($user->mobile);
            }
            // dd($textfile);
            $textfile = json_encode($textfile);
            return view("site.signal.phonenumber",compact("users","textfile","karbaran"));

        } else {
            return redirect()->route("site.signal.login");
        }


    }

}
