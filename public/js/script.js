/* ─── WATER RIPPLE CANVAS ─── */
(function(){
  const canvas = document.getElementById('waterCanvas');
  const ctx = canvas.getContext('2d');
  let ripples = [];

  function resize() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }
  window.addEventListener('resize', resize);
  resize();

  window.addEventListener('mousemove', (e) => {
    if (Math.random() > 0.8) { 
      ripples.push({
        x: e.clientX,
        y: e.clientY,
        r: 2,
        alpha: 0.5,
        lineWidth: 1.5
      });
    }
  });

  function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (let i = ripples.length - 1; i >= 0; i--) {
      const r = ripples[i];
      r.r += 1.2;
      r.alpha -= 0.01;
      r.lineWidth *= 0.98;

      if (r.alpha <= 0) {
        ripples.splice(i, 1);
        continue;
      }

      ctx.beginPath();
      ctx.arc(r.x, r.y, r.r, 0, Math.PI * 2);
      ctx.strokeStyle = `rgba(173, 216, 230, ${r.alpha})`;
      ctx.lineWidth = r.lineWidth;
      ctx.stroke();
    }
    requestAnimationFrame(draw);
  }
  draw();
})();

/* ─── MAGNETIC HERO LETTERS ─── */
(function () {
  const letters = document.querySelectorAll('.hero-title .letter');
  const RADIUS = 160;
  const STRENGTH = 40;

  document.addEventListener('mousemove', (e) => {
    letters.forEach(el => {
      const r = el.getBoundingClientRect();
      const cx = r.left + r.width / 2;
      const cy = r.top + r.height / 2;
      const dx = e.clientX - cx;
      const dy = e.clientY - cy;
      const dist = Math.hypot(dx, dy);

      if (dist < RADIUS) {
        const factor = (1 - dist / RADIUS) * STRENGTH;
        const angle = Math.atan2(dy, dx);
        const tx = Math.cos(angle) * factor;
        const ty = Math.sin(angle) * factor;
        el.style.transform = `translate(${tx}px, ${ty}px)`;
        el.style.color = `var(--blue)`;
      } else {
        el.style.transform = '';
        el.style.color = '';
      }
    });
  });

  /* ─── MAGNETIC INTERACTIVE ELEMENTS ─── */
  const magneticButtons = document.querySelectorAll('.interactive');

  document.addEventListener('mousemove', (e) => {
    magneticButtons.forEach(btn => {
      const r = btn.getBoundingClientRect();
      const cx = r.left + r.width / 2;
      const cy = r.top + r.height / 2;
      const dx = e.clientX - cx;
      const dy = e.clientY - cy;
      const dist = Math.hypot(dx, dy);

      if (dist < 100) {
        btn.style.transform = `translate(${dx * 0.1}px, ${dy * 0.1}px)`;
      } else {
        btn.style.transform = '';
      }
    });
  });
})();

/* ─── SCROLL REVEAL ─── */
(function() {
  // Add reveal class to sections
  const revealTargets = document.querySelectorAll(
    '#about .about-grid, #services .service-card, #skills .skill-item, #skills .skills-intro, #contact .glass-card, .section-header'
  );

  revealTargets.forEach((el, i) => {
    el.classList.add('reveal');
    // Stagger service cards and skill items
    if (el.classList.contains('service-card') || el.classList.contains('skill-item')) {
      el.style.transitionDelay = `${(i % 6) * 0.1}s`;
    }
  });

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.1 });

  revealTargets.forEach(el => observer.observe(el));
})();

/* ─── SKILL BARS ANIMATION ─── */
(function() {
  const fills = document.querySelectorAll('.skill-fill');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const fill = entry.target;
        const targetWidth = fill.getAttribute('data-width');
        // Small delay to let reveal animation run first
        setTimeout(() => {
          fill.style.width = targetWidth + '%';
        }, 300);
        observer.unobserve(fill);
      }
    });
  }, { threshold: 0.3 });

  fills.forEach(fill => observer.observe(fill));
})();

/* ─── SMOOTH SCROLL ─── */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href === '#') return;
    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

/* ─── NAV ACTIVE STATE ─── */
(function() {
  const sections = document.querySelectorAll('section[id], main[id]');
  const navLinks = document.querySelectorAll('.nav-links a');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.id || entry.target.querySelector('[id]')?.id;
        navLinks.forEach(link => {
          link.style.color = '';
          if (link.getAttribute('href') === '#' + id) {
            link.style.color = 'var(--blue)';
          }
        });
      }
    });
  }, { threshold: 0.4 });

  sections.forEach(s => observer.observe(s));
})();
