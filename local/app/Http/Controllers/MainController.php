<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\StudentW;
use App\Lecturer;
use App\News;
use App\Article;
use App\Customer;
use App\Download;
use App\Job;
use App\Testimonial;
use App\Message;
use App\About;
use App\Slider;
use App\Advice;
use App\Department;
use App\Fav;
use App\Moshavere;
use Spatie\Sitemap\SitemapGenerator;
use Validator;

class MainController extends Controller
{
    public function home()
    {
        
        // SitemapGenerator::create('https://uni-everest.com')->writeToFile(public_path('sitemap.xml'));
        $courses = Course::all()->shuffle()->take(12);
        $students = StudentW::all()->shuffle()->take(12);
        $lecturers = Lecturer::all()->shuffle()->take(10);
        $news = News::orderBy('created_at', 'desc')->take(4)->get();
        $articles = Article::orderBy('created_at', 'desc')->take(3)->get();
        $customers = Customer::orderBy('created_at', 'desc')->get();
        $articles2 = Article::orderBy('created_at', 'desc')->take(6)->get();
        $downloads = Download::orderBy('created_at', 'desc')->take(6)->get();
        $jobs = Job::orderBy('created_at', 'desc')->take(6)->get();
        $sliders = Slider::where('active', 'yes')->orderBy('created_at', 'desc')->get();
        $departments = Department::all()->shuffle();
        return view('site.home', compact(
            'sliders',
            'courses',
            'students',
            'lecturers',
            'news',
            'articles',
            'customers',
            'articles2',
            'downloads',
            'jobs',
            'departments'
        ));
    }

    public function students()
    {
        $students = StudentW::orderBy('created_at', 'desc')->paginate(99);
        $courses = Course::take(15)->get();
        return view('site.students', compact('students', 'courses'));
    }

    public function lecturers()
    {
        $lecturers = Lecturer::where('status', 'active')->orderBy('created_at', 'desc')->paginate(100);
        return view('site.lecturers', compact('lecturers'));
    }

    public function customers()
    {
        $customers = Customer::all();
        return view('site.customers', compact('customers'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(16);
        return view('site.testimonials', compact('testimonials'));
    }

    public function contact()
    {
        $message = new Message();
        return view('site.contact', compact('message'));
    }

    public function message(Request $request)
    {
        $data = $this->handleRequest($request);
        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:11|min:11|max:11',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return redirect('/contact')->withErrors($validator)->withInput();
        }
        Message::create($data);
        return redirect('/contact')->with('success', 'پیام با موفقیت ارسال شد! بزودی با شما تماس خواهیم گرفت.');
    }
    
    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $destination = public_path('storage/files/attachments');
            $file->move($destination, $fileName);
            $data['file'] = $fileName;
        }
        return $data;
    }

    public function about()
    {
        $about = About::where('slug', 'about')->first();
        return view('site.about', compact('about'));
    }

    public function aboutin($slug)
    {
        $about = About::where('slug', $slug)->first();
        return view('site.about', compact('about'));
    }

    public function advice(Request $request)
    {
        Advice::create($request->all());
        return "بزودی با شما تماس خواهیم گرفت!";
    }
    
    public function moshavere()
    {
        $favs = Fav::all();
        return view('site.moshavere', compact('favs'));
    }

    public function moshavereSubmit(Request $req)
    {
        $data = $req->all();
        $data['favs'] = isset($data['favs']) ? json_encode($data['favs']) : json_encode([]);
        $validator = Validator::make($data, [
            'name' => 'required',
            'mobile' => 'required|digits:11|min:11|max:11',
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return redirect('/moshavere')->withErrors($validator)->withInput();
        }
        $data['source'] = 'صفحه مشاوره';
        Moshavere::create($data);
        return redirect()->route('site.moshavere')->with('success', 'درخواست مشاوره با موفقیت ثبت شد! کارشناسان ما بزودی با شما تماس خواهند گرفت!');
    }
    
    public function insta()
    {
        $favs = Fav::all();
        return view('site.insta', compact('favs'));
    }

    public function instaSubmit(Request $req)
    {
        $data = $req->all();
        $data['favs'] = isset($data['favs']) ? json_encode($data['favs']) : json_encode([]);
        $validator = Validator::make($data, [
            'name' => 'required',
            'mobile' => 'required|digits:11|min:11|max:11',
            'captcha' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return redirect('/insta')->withErrors($validator)->withInput();
        }
        $data['source'] = 'صفحه اینستاگرام';
        Moshavere::create($data);
        return redirect()->route('site.insta')->with('success', 'درخواست مشاوره با موفقیت ثبت شد! کارشناسان ما بزودی با شما تماس خواهند گرفت!');
    }
    
    public function captchaRef()
    {
        return captcha_img();
    }
}
