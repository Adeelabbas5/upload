<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $service->name }} | Adeel Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow+Condensed:wght@300;400;600;700&family=Share+Tech+Mono&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- NAV -->
    <nav>
        <a href="/" class="nav-brand">M<span>.</span>ADEEL</a>
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-status"></div>
    </nav>

    <!-- SERVICE DETAIL -->
    <section class="section-wrapper">
        
        <div class="container">
            <div class="text-center mb-5">
                <div class="service-icon mb-3" style="font-size: 4rem;"><i class="{{ $service->icon }}"></i></div>
                <h1 class="section-heading">{{ $service->name }}</h1>
                <div class="heading-underline"></div>
            </div>
            <div class="service-detail">
                <div class="service-overview glass-card">
                    <div class="service-overview-header">
                        <span class="section-eyebrow">SERVICE OVERVIEW</span>
                        <h3>{{ $service->name }}</h3>
                    </div>
                    <p class="about-desc">{{ $service->description }}</p>
                    @if ($service->details)
                        <div class="service-highlight-text">
                            <p>{{ $service->details }}</p>
                        </div>
                    @endif
                </div>

                @if ($service->works->count() > 0)
                    @foreach ($service->works as $work)
                        <div class="service-work-section glass-card">
                            <div class="work-header">
                                <span class="section-eyebrow">WORK EXAMPLE</span>
                                <h3>{{ $work->title }}</h3>
                                @if ($work->year)
                                    <p class="work-year">{{ $work->year }}</p>
                                @endif
                            </div>
                            @if ($work->description)
                                <p class="about-desc">{{ $work->description }}</p>
                            @endif
                            @if ($work->link)
                                <p><a href="{{ $work->link }}" target="_blank" class="service-resource-link">View Work</a></p>
                            @endif
                            @if (!empty($work->screenshots) && is_array($work->screenshots))
                                <div class="work-gallery">
                                    @foreach ($work->screenshots as $screenshot)
                                        <div class="service-gallery-item">
                                            <img src="{{ asset($screenshot) }}" alt="Work screenshot">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    @if (!empty($service->screenshots) && is_array($service->screenshots))
                        <div class="service-showcase">
                            <div class="showcase-header">
                                <span class="section-eyebrow">SHOWCASE</span>
                                <h3>Project Gallery</h3>
                                <p class="about-desc">Multiple work examples displayed in a professional gallery layout.</p>
                            </div>
                            <div class="service-gallery-grid">
                                @foreach ($service->screenshots as $screenshot)
                                    <div class="service-gallery-item">
                                        <img src="{{ asset($screenshot) }}" alt="Service screenshot">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

                <div class="service-detail-actions">
                    <a href="/" class="btn-ghost interactive">
                        <i class="fas fa-arrow-left me-2"></i>Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="site-footer">
        <p class="font-mono small" style="color: var(--dim)">© 2026 M.ADEEL — Crafted with <span
                class="text-blue">precision</span></p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
