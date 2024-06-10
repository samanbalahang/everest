<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->paginate(16);
        return view('site.testimonials.index', compact('testimonials'));
    }

    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $views = $testimonial->views + 1;
        $testimonial->update([
            'views' => $views
        ]);
        return view('site.testimonials.show', compact('testimonial'));
    }
}
