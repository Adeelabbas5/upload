<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Service;
use App\Models\Contact;
use App\Models\Skill;
use App\Models\About;

class HomeController extends Controller
{
    public function index()
    {
        $services = Cache::remember('home_services', 600, fn() => Service::all());
        $skills = Cache::remember('home_skills', 600, fn() => Skill::all());
        $about = Cache::remember('home_about', 600, fn() => About::first());
        return view('index', compact('services', 'skills', 'about'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Thank you for your message! I will get back to you soon.');
    }
}
