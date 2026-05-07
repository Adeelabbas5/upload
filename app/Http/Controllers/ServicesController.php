<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function show($id)
    {
        $service = Service::with('works')->findOrFail($id);
        return view('service', compact('service'));
    }

    public function update(Request $request, $id)
{
    $service = Service::findOrFail($id);

    $request->validate([
        'name' => 'required|string',
        'screenshots.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120' // Max 5MB per image
    ]);

    $data = $request->only(['name', 'description', 'details', 'icon', 'resource_link']);

    // Handle Image Uploads
    if ($request->hasFile('screenshots')) {
        $paths = $service->screenshots ?? []; // Keep existing images if any

        foreach ($request->file('screenshots') as $file) {
            // Generate unique name and store in public/uploads/services
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/services'), $fileName);
            $paths[] = 'uploads/services/' . $fileName;
        }
        
        $data['screenshots'] = $paths;
    }

    $service->update($data);

    return redirect()->back()->with('success', 'Service updated successfully!');
}
}
