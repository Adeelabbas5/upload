<?php 

// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $contactsCount = Contact::count();
        $projectsCount = Service::count();
        $skillsCount = Skill::count();

        // Recent 5 contacts
        $recentContacts = Contact::latest()
            ->take(5)
            ->get();

        // Optional: Unread messages count (if you have 'read_at' column)
        $unreadCount = Contact::whereNull('read_at')->count();

        return view('admin.index', compact(
            'contactsCount',
            'projectsCount',
            'skillsCount',
            'recentContacts',
            'unreadCount'
        ));
    }
}

?>