<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adeel | Portfolio</title>
    <link rel="icon" type="image/png" href="{{ asset('lol.png') }}">
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
    <canvas class="wake-canvas" id="waterCanvas"></canvas>

    <!-- NAV -->
    <nav>
        <a href="#" class="nav-brand">M<span>.</span>ADEEL</a>
        <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#contact">Contact</a></li>
            {{-- <li><a href="/admin" style="color: #007bff;">Admin</a></li> --}}
        </ul>
        <div class="nav-status"></div>
    </nav>

    <!-- HERO -->
    <main class="content-overlay d-flex align-items-center justify-content-center" style="margin-top: 50px">
        <section id="hero">
            <div class="hero-eyebrow">Product Designer · UI/UX Designer · Content Lead</div>
            <h1 class="hero-title" id="heroTitle">
                <span class="letter">A</span><span class="letter">D</span><span class="letter">E</span><span
                    class="letter">E</span><span class="letter">L</span>
            </h1>
            <div class="hero-sub">Muhammad <span>Adeel</span> Abbas</div>
            <div class="hero-bio">Product Designer and UI/UX Specialist experienced in bridging design, content, and
                strategy to build engaging digital experiences.<br> Adept at translating complex ideas into intuitive
                interfaces, with a strong background in branding, user research, and content leadership.<br> Passionate
                about creating visually compelling, user-centered products that drive engagement and business impact..
            </div>
            <div class="hero-social">
                {{-- <a href="#" class="social-link interactive"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link interactive"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link interactive"><i class="fab fa-github"></i></a> --}}
                <a href="https://www.linkedin.com/in/syed-adeel-abbas-97a2bb246?utm_source=share_via&utm_content=profile&utm_medium=member_android"
                    class="social-link interactive"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="hero-cta">
                <a href="#about" class="btn-electric interactive">View Work</a>
                <a href="#contact" class="btn-ghost interactive">Get In Touch</a>
            </div>
            <div class="hero-scroll-hint">
                <span>Scroll</span>
                <div class="scroll-line"></div>
            </div>
        </section>
    </main>

    <!-- ABOUT -->
    <section id="about" class="section-wrapper">
        <div class="section-label">01 // ABOUT ME</div>
        <div class="section-bg-text">ABOUT</div>
        <div class="container">
            <div class="about-grid">
                <!-- Left: Photo -->
                <div class="about-photo-col">
                    <div class="about-photo-frame">
                        <img src="{{ isset($about) && $about->photo_path ? asset($about->photo_path) : 'https://cilisos.my/wp-content/uploads/2016/07/unknown-person-icon-Image-from.png' }}"
                            alt="Adeel" class="about-photo">
                        <div class="photo-glow"></div>
                    </div>
                </div>
                <!-- Right: Info -->
                <div class="about-info-col">
                    {{-- <span class="section-eyebrow">01 // THE_ORIGIN</span> --}}
                    <h2 class="section-heading">{{ $about->heading ?? 'Hi There! I\'m Muhammad Adeel' }}</h2>
                    <p class="about-role text-blue">{{ $about->role ?? 'N/A' }}</p>
                    <p class="about-desc">
                        {{ $about->description ?? 'N/A' }}
                    </p>
                    <div class="about-details">
                        <div class="detail-row">
                            <span class="detail-label">Birthday</span>
                            <span class="detail-value">{{ $about->birthday ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Phone</span>
                            <span class="detail-value">{{ $about->phone ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">{{ $about->email ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Language</span>
                            <span class="detail-value">{{ $about->language ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">From</span>
                            <span class="detail-value">{{ $about->location ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Freelance</span>
                            <span class="detail-value available">{{ $about->freelance_status ?? 'N/A' }}</span>
                        </div>
                    </div>
                    @if (isset($about) && $about->cv_path)
                        <a href="{{ asset($about->cv_path) }}" class="btn-electric interactive mt-4 d-inline-block"
                            download>
                            <i class="fas fa-download me-2"></i>Download CV
                        </a>
                    @else
                        <a href="#" class="btn-electric interactive mt-4 d-inline-block disabled">
                            <i class="fas fa-download me-2"></i>Download CV
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="section-wrapper">
        <div class="section-bg-text">SERVICES</div>
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="section-eyebrow">02 // WHAT_I_DO</span>
                <h2 class="section-heading">Services</h2>
                <div class="heading-underline"></div>
            </div>
            <div class="services-grid">
                @foreach ($services as $service)
                    <a href="{{ route('service.show', $service->id) }}" class="service-card glass-card interactive">
                        <div class="service-icon"><i class="{{ $service->icon }}"></i></div>
                        <h3 class="service-title">{{ $service->name }}</h3>
                        <p class="service-desc">{{ $service->description }}</p>
                        <span class="service-details-link">View details</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SKILLS -->
    <section id="skills" class="section-wrapper">
        <div class="section-bg-text">SKILLS</div>
        <div class="container">
            <div class="skills-grid">
                <!-- Left: Heading -->
                <div class="skills-intro">
                    <span class="section-eyebrow">03 // EXPERTISE</span>
                    <h2 class="section-heading">All the skills that I have in<br>that field of work are<br><span
                            class="text-blue">mentioned.</span></h2>
                    <p class="about-desc mt-3">A curated stack of tools and technologies I use to build exceptional
                        digital products — from concept to deployment.</p>
                    <a href="#contact" class="btn-ghost interactive mt-4 d-inline-block">Hire Me</a>
                </div>
                <!-- Right: Bars -->
                <div class="skills-bars">
                    @foreach ($skills as $skill)
                        <div class="skill-item">
                            <div class="skill-meta">
                                <span class="skill-name">{{ $skill->name }}</span>
                                <span class="skill-pct">{{ $skill->percentage }}%</span>
                            </div>
                            <div class="skill-track">
                                <div class="skill-fill" data-width="{{ $skill->percentage }}"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="section-wrapper">
        <div class="section-bg-text">CONTACT</div>
        <div class="container">
            <div class="section-header text-center mb-5">
                <span class="section-eyebrow">04 // GET_IN_TOUCH</span>
                <h2 class="section-heading">Contact Me</h2>
                <div class="heading-underline"></div>
            </div>
            <div class="contact-grid">
                <div class="contact-info glass-card">
                    <h3 class="contact-sub text-blue font-mono mb-4">Let's Build Together</h3>
                    <p class="about-desc mb-4">Have a project in mind? Let's create something extraordinary. I'm
                        available for freelance and full-time opportunities.</p>
                    <div class="contact-detail">
                        <i class="fas fa-envelope text-blue"></i>
                        <span>{{ $about->email ?? 'Email not available' }}</span>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-phone text-blue"></i>
                        <span>{{ $about->phone ?? 'Phone not available' }}</span>
                    </div>
                    <div class="contact-detail">
                        <i class="fas fa-map-marker-alt text-blue"></i>
                        <span>{{ $about->location ?? 'Location not available' }}</span>
                    </div>
                    <div class="footer-social mt-4">
                        {{-- <a href="#" class="social-link interactive"><i class="fab fa-github"></i></a> --}}
                        <a href="https://www.linkedin.com/in/syed-adeel-abbas-97a2bb246?utm_source=share_via&utm_content=profile&utm_medium=member_android"
                            class="social-link interactive"><i class="fab fa-linkedin-in"></i></a>
                        {{-- <a href="#" class="social-link interactive"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link interactive"><i class="fab fa-dribbble"></i></a> --}}
                    </div>
                </div>
                <form class="contact-form glass-card" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success mb-3">{{ session('success') }}</div>
                    @endif
                    <div class="form-group mb-3">
                        <input type="text" name="name" class="form-input" placeholder="Your Name" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="email" class="form-input" placeholder="Your Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="subject" class="form-input" placeholder="Subject" required>
                    </div>
                    <div class="form-group mb-4">
                        <textarea name="message" class="form-input" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn-electric interactive w-100">
                        <i class="fas fa-paper-plane me-2"></i>Send Message
                    </button>
                </form>
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
