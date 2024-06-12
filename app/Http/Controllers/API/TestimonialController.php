<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        foreach ($testimonials as $testimonial) {
            $testimonial->image = asset('uploads/testimonials/' . $testimonial->image);
        }
        return response()->json(['message' => 'Testimonials retrieved successfully.', 'data' => $testimonials], 200);
    }

    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        if ($testimonial) {
            $testimonial->image = asset('uploads/testimonials/' . $testimonial->image);
            return response()->json(['message' => 'Testimonial retrieved successfully.', 'data' => $testimonial], 200);
        } else {
            return response()->json(['message' => 'Testimonial not found.'], 404);
        }
    }
}
