@extends('admin.layouts.admin')

@section('content')

<style>
    /* =========================
       DYNAMIC LAYOUT FIX
    ========================== */
    :root {
        --sidebar-width: 280px; /* Matches your master layout */
        --accent-blue: #0071e3;
        --glass-bg: rgba(255, 255, 255, 0.04);
        --glass-border: rgba(255, 255, 255, 0.08);
    }

    /* Target the section without forced margins */
    #main {
        width: 100%;
        min-height: 100vh;
        padding: 40px; /* Reduced from 100px to standard breathing room */
        overflow-x: hidden;
    }

    .dashboard-wrapper {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================
       HEADER STYLING
    ========================== */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 40px;
    }

    .dashboard-title h1 {
        font-size: 2.2rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin: 0 0 8px 0;
        color: #ffffff;
    }

    .dashboard-title p {
        color: #86868b;
        font-size: 1rem;
        margin: 0;
    }

    /* =========================
       APPLE-STYLE BUTTONS
    ========================== */
    .btn-dashboard {
        padding: 12px 24px;
        border-radius: 50px; /* Capsule style */
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary-dashboard {
        background: var(--accent-blue);
        color: #fff;
        box-shadow: 0 4px 14px rgba(0, 113, 227, 0.3);
    }

    .btn-secondary-dashboard {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
    }

    .btn-danger-dashboard {
        background: #dc3545;
        color: #fff;
        border: none;
    }

    .btn-dashboard:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 20px rgba(0, 113, 227, 0.4);
    }

    /* =========================
       GLASS BENTO GRID
    ========================== */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .dashboard-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 22px;
        padding: 30px;
        backdrop-filter: blur(20px) saturate(180%);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: block;
    }

    .dashboard-card:hover {
        border-color: var(--accent-blue);
        transform: translateY(-8px);
        background: rgba(0, 113, 227, 0.08);
        box-shadow: 0 12px 35px rgba(0, 113, 227, 0.2);
    }

    .dashboard-card h3 {
        color: #86868b;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 15px;
        font-family: 'Share Tech Mono', monospace;
    }

    .dashboard-card .value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff;
    }

    /* =========================
       CONTENT SPLIT (TABLE vs ACTIONS)
    ========================== */
    .dashboard-content {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    .activity-card, .quick-card {
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 22px;
        padding: 30px;
        backdrop-filter: blur(20px);
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: #fff;
    }

    /* --- Floating Table Style --- */
    .dashboard-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .dashboard-table th {
        color: #86868b;
        font-size: 0.75rem;
        text-transform: uppercase;
        padding: 0 15px;
        text-align: left;
    }

    .dashboard-table tr td {
        background: rgba(255, 255, 255, 0.03);
        padding: 18px 15px;
        color: #e5e7eb;
        border-top: 1px solid var(--glass-border);
        border-bottom: 1px solid var(--glass-border);
    }

    .dashboard-table tr td:first-child { border-left: 1px solid var(--glass-border); border-radius: 12px 0 0 12px; }
    .dashboard-table tr td:last-child { border-right: 1px solid var(--glass-border); border-radius: 0 12px 12px 0; }

    /* --- Quick Action Links --- */
    .quick-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .quick-action {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--glass-border);
        border-radius: 15px;
        padding: 20px;
        text-decoration: none;
        transition: 0.3s;
    }

    .quick-action:hover {
        background: rgba(0, 113, 227, 0.1);
        border-color: var(--accent-blue);
        transform: translateX(8px);
    }

    .quick-action h4 { color: #fff; margin: 0 0 5px 0; font-size: 1rem; }
    .quick-action p { color: #86868b; margin: 0; font-size: 0.85rem; }

    /* =========================
       RESPONSIVE
    ========================== */
    @media(max-width: 1100px){
        .dashboard-content { grid-template-columns: 1fr; }
    }

    @media(max-width: 768px){
        #main { padding: 20px; }
        .dashboard-header { flex-direction: column; align-items: flex-start; }
        .dashboard-title h1 { font-size: 1.8rem; }
    }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-header">
        <div class="dashboard-title">
            <h1>Admin Dashboard</h1>
            <p>Welcome back, Muhammad. Here is your portfolio status.</p>
        </div>
        <div class="dashboard-actions">
            <a href="/" class="btn-dashboard btn-secondary-dashboard">
                <i class="fas fa-external-link-alt"></i> View Site
            </a>
            <a href="/admin/contacts" class="btn-dashboard btn-primary-dashboard">
                <i class="fas fa-envelope"></i> Messages
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn-dashboard btn-danger-dashboard">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div class="dashboard-grid">
        {{-- <a href="/admin/contacts" class="dashboard-card" style="text-decoration: none; cursor: pointer;">
            <h3>Total Messages</h3>
            <div class="value">{{ $contactsCount ?? 0 }}</div>
        </a> --}}
        <a href="/admin/services" class="dashboard-card" style="text-decoration: none; cursor: pointer;">
            <h3>Total Projects</h3>
            <div class="value">{{ $projectsCount ?? 0 }}</div>
        </a>
        <a href="/admin/skills" class="dashboard-card" style="text-decoration: none; cursor: pointer;">
            <h3>Active Skills</h3>
            <div class="value">{{ $skillsCount ?? 0 }}</div>
        </a>
    </div>

    <div class="dashboard-content">
        <div class="activity-card">
            <h2 class="section-title">Recent Inquiries</h2>
            <div style="overflow-x: auto;">
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentContacts ?? [] as $contact)
                            <tr>
                                <td style="font-weight: 600;">{{ $contact->name }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td style="color: #86868b;">{{ $contact->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color: #86868b;">No recent messages.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

       <div class="quick-card">
    <h2 class="section-title">Quick Tasks</h2>
    <div class="quick-actions">
        <a href="{{ url('/admin/services') }}" class="quick-action">
            <h4>Manage Services</h4>
            <p>Update your latest work</p>
        </a>

        <a href="{{ url('/admin/skills') }}" class="quick-action">
            <h4>Update Skills</h4>
            <p>Add new technologies</p>
        </a>

        <a href="{{ url('/admin/about') }}" class="quick-action">
            <h4>Edit Bio</h4>
            <p>Keep your profile fresh</p>
        </a>
    </div>
</div>
    </div>
</div>

@endsection