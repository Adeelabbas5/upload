@extends('admin.layouts.admin')

@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =========================
           GLOBAL THEME
        ========================= */
        html, body {
            background: #070b14 !important;
            color: #ffffff !important;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        .admin-container {
            padding: 40px;
            background: transparent !important;
            color: #ffffff !important;
        }

        /* =========================
           TABLE
        ========================= */
        .table-responsive {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .table {
            margin-bottom: 0;
            background: rgba(255, 255, 255, 0.02) !important;
            --bs-table-bg: transparent !important;
            --bs-table-color: #ffffff !important;
            --bs-table-border-color: rgba(255, 255, 255, 0.06) !important;
        }

        .table thead th {
            background: rgba(255, 255, 255, 0.05) !important;
            color: #4f8cff !important;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 20px;
            font-family: 'Share Tech Mono', monospace;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .table tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            color: #d1d5db !important;
            background: transparent !important;
        }

        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.04) !important;
        }

        /* =========================
           MODAL BACKDROP BLUR
        ========================= */
        .modal-backdrop {
            --bs-backdrop-bg: none !important;
            --bs-backdrop-opacity: 0 !important;
            background-color: rgba(4, 7, 14, 0.82) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            backdrop-filter: blur(12px) !important;
        }

        .modal-backdrop.show {
            --bs-backdrop-bg: none !important;
            --bs-backdrop-opacity: 0 !important;
            background-color: rgba(4, 7, 14, 0.82) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            backdrop-filter: blur(12px) !important;
        }

        /* =========================
           MODAL CONTENT - SOLID BG
        ========================= */
        .modal.fade .modal-dialog {
            transform: translateY(30px) scale(0.95);
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modal.show .modal-dialog {
            transform: translateY(0) scale(1);
        }

        .modal-content {
            background: #111827 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 24px !important;
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.05) !important;
            color: #ffffff !important;
            position: relative;
            overflow: hidden;
        }

        .modal-content::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #4f8cff, transparent);
            opacity: 0.7;
            z-index: 1;
        }

        .modal-content::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(79, 140, 255, 0.05), transparent 70%);
            top: -80px;
            right: -80px;
            pointer-events: none;
        }

        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
            padding: 22px 28px;
            position: relative;
            z-index: 2;
        }

        .modal-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.06) !important;
            padding: 18px 28px;
            position: relative;
            z-index: 2;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #ffffff !important;
        }

        /* =========================
           MODAL BODY - READABLE
        ========================= */
        .modal-body {
            padding: 25px 28px;
            position: relative;
            z-index: 2;
            overflow-y: auto;
            max-height: 60vh;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .modal-body p {
            margin-bottom: 10px;
            font-size: 0.92rem;
            color: #c2c8d3 !important;
        }

        .modal-body strong {
            color: #4f8cff;
        }

        .modal-message-text {
            white-space: pre-wrap;
            font-size: 0.93rem;
            line-height: 1.7;
            color: #e2e8f0 !important;
        }

        .modal-divider {
            border: none;
            height: 1px;
            background: rgba(255, 255, 255, 0.08);
            margin: 18px 0;
        }

        /* Modal scrollbar */
        .modal-body::-webkit-scrollbar {
            width: 6px;
        }

        .modal-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 20px;
        }

        .modal-body::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        /* Close button */
        .btn-close {
            filter: invert(1) brightness(180%);
            opacity: 0.5;
            transition: 0.3s;
            box-shadow: none !important;
        }

        .btn-close:hover {
            opacity: 1;
            filter: invert(1) brightness(200%);
        }

        /* =========================
           BUTTONS
        ========================= */
        .btn-info {
            background: linear-gradient(135deg, #0071e3, #4f8cff) !important;
            border: none !important;
            color: #fff !important;
            border-radius: 10px !important;
            padding: 6px 16px !important;
            font-weight: 600;
            font-size: 0.82rem;
            transition: 0.3s;
        }

        .btn-info:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79, 140, 255, 0.35);
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 6px 14px;
            border-radius: 8px;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: #fff;
        }

        .btn-outline-light-custom {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #c2c8d3;
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-outline-light-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* =========================
           ALERT
        ========================= */
        .admin-alert.success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            padding: 15px 20px;
            border-radius: 14px;
            margin-bottom: 30px;
        }
    </style>

    <div class="admin-container">
        <h2 class="mb-4">Contact Messages</h2>

        @if (session('success'))
            <div class="admin-alert success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sender</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td style="font-family: 'Share Tech Mono'; opacity: 0.6;">#{{ $contact->id }}</td>
                            <td class="fw-bold text-white">{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#msgModal{{ $contact->id }}">
                                    View Message
                                </button>
                            </td>
                            <td>{{ $contact->created_at->format('M d, Y') }}</td>
                            <td>
                                <form action="{{ url('/admin/contacts/' . $contact->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- =============================================
             MODALS - OUTSIDE TABLE
        ============================================= --}}
        @foreach ($contacts as $contact)
            <div class="modal fade" id="msgModal{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $contact->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Subject:</strong> {{ $contact->subject }}</p>
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                            <hr class="modal-divider">
                            <div class="modal-message-text">{{ $contact->message }}</div>
                        </div>
                        <div class="modal-footer">
                            <a href="mailto:{{ $contact->email }}" class="btn btn-info btn-sm">Reply Now</a>
                            <button type="button" class="btn-outline-light-custom" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <a href="/" class="btn mt-4" style="background: rgba(255,255,255,0.05); color: #fff; border: 1px solid rgba(255,255,255,0.08); border-radius: 10px;">← Back to Website</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection