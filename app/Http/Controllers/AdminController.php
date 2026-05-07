<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Contact;
use App\Models\About;
use App\Models\Work;

class AdminController extends Controller
{
    public function index()
    {
        $contactsCount = Cache::remember('contacts_count', 300, fn() => Contact::count());
        $projectsCount = Cache::remember('projects_count', 300, fn() => Service::count());
        $skillsCount = Cache::remember('skills_count', 300, fn() => Skill::count());
        $recentContacts = Contact::latest()->take(5)->get();
        
        return view('admin.index', compact('contactsCount', 'projectsCount', 'skillsCount', 'recentContacts'));
    }

    /* ------------------------------------------------------------------ */
    /*  ABOUT                                                             */
    /* ------------------------------------------------------------------ */

    public function about()
    {
        $about = About::first();
        return view('admin.about', compact('about'));
    }

    public function editAbout()
    {
        $about = About::first();
        return view('admin.about-edit', compact('about'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'heading'          => 'required|string|max:255',
            'role'             => 'required|string|max:255',
            'language'         => 'nullable|string|max:255',
            'birthday'         => 'nullable|string|max:255',
            'location'         => 'nullable|string|max:255',
            'freelance_status' => 'nullable|string|max:255',
            'description'      => 'required|string',
            'phone'            => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'cv'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $about = About::first() ?? new About();
        
        // Update text fields
        $about->fill($request->only([
            'heading', 'role', 'language', 'birthday', 'location', 
            'freelance_status', 'description', 'phone', 'email'
        ]));

        $uploadPath = public_path('uploads/about');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // Handle Photo Upload
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            if ($about->photo_path && File::exists(public_path($about->photo_path))) {
                File::delete(public_path($about->photo_path));
            }
            $file = $request->file('photo');
            $filename = time() . '_photo.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $about->photo_path = 'uploads/about/' . $filename;
        }

        // Handle CV Upload
        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            if ($about->cv_path && File::exists(public_path($about->cv_path))) {
                File::delete(public_path($about->cv_path));
            }
            $file = $request->file('cv');
            $filename = time() . '_cv.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $about->cv_path = 'uploads/about/' . $filename;
        }

        $about->save();
        Cache::forget('home_about');

        return redirect()->route('admin.about.index')->with('success', 'About section updated successfully.');
    }

    public function destroyAbout()
    {
        $about = About::first();
        if ($about) {
            if ($about->photo_path) File::delete(public_path($about->photo_path));
            if ($about->cv_path) File::delete(public_path($about->cv_path));
            $about->delete();
        }

        Cache::forget('home_about');
        return redirect()->route('admin.about.index')->with('success', 'About section deleted successfully.');
    }

    /* ------------------------------------------------------------------ */
    /*  SKILLS                                                            */
    /* ------------------------------------------------------------------ */

    public function skills()
    {
        $skills = Skill::all();
        return view('admin.skills', compact('skills'));
    }

    public function storeSkill(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        Skill::create($request->only(['name', 'percentage']));
        Cache::forget('skills_count');
        Cache::forget('home_skills');

        return redirect()->back()->with('success', 'Skill added successfully.');
    }

    public function updateSkill(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
        ]);

        Skill::findOrFail($id)->update($request->only(['name', 'percentage']));
        Cache::forget('home_skills');

        return redirect()->back()->with('success', 'Skill updated successfully.');
    }

    public function destroySkill($id)
    {
        Skill::findOrFail($id)->delete();
        Cache::forget('skills_count');
        Cache::forget('home_skills');

        return redirect()->back()->with('success', 'Skill deleted successfully.');
    }

    /* ------------------------------------------------------------------ */
    /*  SERVICES                                                          */
    /* ------------------------------------------------------------------ */

    public function services()
    {
        $services = Service::with('works')->get();
        return view('admin.services', compact('services'));
    }

    public function storeService(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'icon'          => 'required|string|max:255',
            'description'   => 'required|string',
            'details'       => 'nullable|string',
            'resource_link' => 'nullable|url|max:255',
            'resource_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'screenshots'   => 'nullable|array',
            'screenshots.*' => 'image|max:2048',
        ]);

        $service = new Service($request->only(['name', 'icon', 'description', 'details', 'resource_link']));

        if ($request->hasFile('resource_file') && $request->file('resource_file')->isValid()) {
            $file = $request->file('resource_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $service->resource_path = 'uploads/services/' . $filename;
        }

        if ($request->hasFile('screenshots')) {
            $screenshots = [];
            foreach ($request->file('screenshots') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/services/screenshots'), $filename);
                $screenshots[] = 'uploads/services/screenshots/' . $filename;
            }
            $service->screenshots = $screenshots;
        }

        $service->save();
        Cache::forget('projects_count');
        Cache::forget('home_services');

        return redirect()->back()->with('success', 'Service added successfully.');
    }

    public function updateService(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        
        $request->validate([
            'name'          => 'required|string|max:255',
            'icon'          => 'required|string|max:255',
            'description'   => 'required|string',
            'screenshots.*' => 'image|max:2048',
        ]);

        $service->fill($request->only(['name', 'icon', 'description', 'details', 'resource_link']));

        if ($request->hasFile('resource_file')) {
            if ($service->resource_path) File::delete(public_path($service->resource_path));
            $file = $request->file('resource_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $service->resource_path = 'uploads/services/' . $filename;
        }

        if ($request->hasFile('screenshots')) {
            $existing = $service->screenshots ?? [];
            foreach ($request->file('screenshots') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/services/screenshots'), $filename);
                $existing[] = 'uploads/services/screenshots/' . $filename;
            }
            $service->screenshots = $existing;
        }

        $service->save();
        Cache::forget('home_services');

        return redirect()->back()->with('success', 'Service updated successfully.');
    }

    public function destroyService($id)
    {
        $service = Service::findOrFail($id);
        if ($service->resource_path) File::delete(public_path($service->resource_path));
        if ($service->screenshots) {
            foreach($service->screenshots as $path) File::delete(public_path($path));
        }
        $service->delete();

        Cache::forget('projects_count');
        Cache::forget('home_services');

        return redirect()->back()->with('success', 'Service deleted successfully.');
    }

    /* ------------------------------------------------------------------ */
    /*  WORKS                                                             */
    /* ------------------------------------------------------------------ */

    public function storeWork(Request $request, $serviceId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'screenshots.*' => 'image|max:2048',
        ]);

        $work = new Work($request->only(['title', 'description', 'link', 'year']));
        $work->service_id = $serviceId;

        if ($request->hasFile('screenshots')) {
            $paths = [];
            foreach ($request->file('screenshots') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/works/screenshots'), $filename);
                $paths[] = 'uploads/works/screenshots/' . $filename;
            }
            $work->screenshots = $paths;
        }

        $work->save();
        return redirect()->back()->with('success', 'Work added successfully.');
    }

    public function updateWork(Request $request, $serviceId, $workId)
    {
        $work = Work::where('service_id', $serviceId)->findOrFail($workId);
        $work->fill($request->only(['title', 'description', 'link', 'year']));

        if ($request->hasFile('screenshots')) {
            $existing = $work->screenshots ?? [];
            foreach ($request->file('screenshots') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/works/screenshots'), $filename);
                $existing[] = 'uploads/works/screenshots/' . $filename;
            }
            $work->screenshots = $existing;
        }

        $work->save();
        return redirect()->back()->with('success', 'Work updated successfully.');
    }

    public function destroyWork($serviceId, $workId)
    {
        $work = Work::where('service_id', $serviceId)->findOrFail($workId);
        if ($work->screenshots) {
            foreach($work->screenshots as $path) File::delete(public_path($path));
        }
        $work->delete();
        return redirect()->back()->with('success', 'Work deleted successfully.');
    }

    /* ------------------------------------------------------------------ */
    /*  CONTACTS                                                          */
    /* ------------------------------------------------------------------ */

    public function contacts()
    {
        $contacts = Contact::all();
        return view('admin.contacts', compact('contacts'));
    }

    public function destroyContact($id)
    {
        Contact::findOrFail($id)->delete();
        Cache::forget('contacts_count');
        return redirect()->back()->with('success', 'Message deleted successfully.');
    }
}