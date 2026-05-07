@extends('admin.layouts.admin')

@section('content')

<style>
    .admin-container {
        padding: 30px;
        color: #fff;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .header-info h2 {
        margin: 0;
        font-size: 32px;
        font-weight: 700;
    }

    .header-info p {
        margin-top: 6px;
        color: rgba(255,255,255,0.6);
    }

    .header-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-save,
    .btn-delete {
        border: none;
        padding: 12px 22px;
        border-radius: 16px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 600;
        transition: .3s ease;
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .btn-save {
        background: rgba(0,191,255,0.15);
        color: #00BFFF;
        border: 1px solid rgba(0,191,255,0.25);
    }

    .btn-save:hover {
        background: rgba(0,191,255,0.25);
        transform: translateY(-2px);
    }

    .btn-delete {
        background: rgba(255,0,80,0.12);
        color: #ff4d7a;
        border: 1px solid rgba(255,0,80,0.25);
    }

    .btn-delete:hover {
        background: rgba(255,0,80,0.22);
        transform: translateY(-2px);
    }

    .admin-alert.success {
        background: rgba(0,255,140,0.1);
        border: 1px solid rgba(0,255,140,0.2);
        color: #00ff9d;
        padding: 14px 18px;
        border-radius: 16px;
        margin-bottom: 25px;
    }

    .card {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 28px;
        padding: 30px;
        backdrop-filter: blur(24px) saturate(180%);
        -webkit-backdrop-filter: blur(24px) saturate(180%);
        box-shadow: 0 10px 40px rgba(0,0,0,0.35);
    }

    .card-label {
        display: inline-block;
        margin-bottom: 20px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #00BFFF;
    }

    .about-preview {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 35px;
        align-items: start;
    }

    .about-preview-left img {
        width: 100%;
        height: 340px;
        object-fit: cover;
        border-radius: 22px;
        border: 1px solid rgba(255,255,255,0.08);
        box-shadow: 0 15px 35px rgba(0,0,0,0.35);
    }

    .about-preview-right h3 {
        margin-top: 0;
        font-size: 34px;
        margin-bottom: 8px;
    }

    .text-blue {
        color: #00BFFF;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .about-description {
        color: rgba(255,255,255,0.72);
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: 16px;
    }

    .detail-card {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        border-radius: 18px;
        padding: 16px;
    }

    .detail-label {
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,0.45);
        margin-bottom: 6px;
    }

    .detail-value {
        color: #fff;
        word-break: break-word;
    }

    .cv-link {
        color: #00BFFF;
        text-decoration: none;
    }

    .cv-link:hover {
        text-decoration: underline;
    }

    @media(max-width: 900px) {
        .about-preview {
            grid-template-columns: 1fr;
        }

        .about-preview-left {
            max-width: 320px;
            margin: auto;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="admin-container">

    <header class="admin-header">
        <div class="header-info">
            <h2>About Section</h2>
            <p>View or manage your portfolio About content.</p>
        </div>

        <div class="header-actions">
            <a href="{{ route('admin.about.edit') }}" class="btn-save">
                Edit About
            </a>

            @if($about)
                <form action="{{ route('admin.about.destroy') }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete the About section?');">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-delete">
                        Delete About
                    </button>
                </form>
            @endif
        </div>
    </header>

    @if(session('success'))
        <div class="admin-alert success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <label class="card-label">
            About Preview
        </label>

        @if($about)

            <div class="about-preview">

                <div class="about-preview-left">
                    <img src="{{ $about->photo_path ? asset($about->photo_path) : 'https://cilisos.my/wp-content/uploads/2016/07/unknown-person-icon-Image-from.png' }}"
                         alt="About Photo">
                </div>

                <div class="about-preview-right">

                    <h3>{{ $about->heading }}</h3>

                    <p class="text-blue">
                        {{ $about->role }}
                    </p>

                    <p class="about-description">
                        {{ $about->description }}
                    </p>

                    <div class="details-grid">

                        <div class="detail-card">
                            <span class="detail-label">Birthday</span>
                            <div class="detail-value">{{ $about->birthday }}</div>
                        </div>

                        <div class="detail-card">
                            <span class="detail-label">Phone</span>
                            <div class="detail-value">{{ $about->phone }}</div>
                        </div>

                        <div class="detail-card">
                            <span class="detail-label">Email</span>
                            <div class="detail-value">{{ $about->email }}</div>
                        </div>

                        <div class="detail-card">
                            <span class="detail-label">Language</span>
                            <div class="detail-value">{{ $about->language }}</div>
                        </div>

                        <div class="detail-card">
                            <span class="detail-label">Location</span>
                            <div class="detail-value">{{ $about->location }}</div>
                        </div>

                        <div class="detail-card">
                            <span class="detail-label">Freelance</span>
                            <div class="detail-value">{{ $about->freelance_status }}</div>
                        </div>

                        @if($about->cv_path)
                            <div class="detail-card">
                                <span class="detail-label">CV</span>

                                <div class="detail-value">
                                    <a href="{{ asset($about->cv_path) }}"
                                       target="_blank"
                                       class="cv-link">
                                        Download Current CV
                                    </a>
                                </div>
                            </div>
                        @endif

                    </div>

                </div>

            </div>

        @else

            <p style="color: rgba(255,255,255,0.6);">
                No About content has been created yet.
            </p>

        @endif

    </div>

</div>

@endsection