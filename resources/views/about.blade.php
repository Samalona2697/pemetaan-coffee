<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Kami - Pemetaan Coffee Medan</title>
    
    <!-- Favicon -->
    <link rel="icon" href="https://laravel.com/img/favicon/favicon-32x32.png" type="image/png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <script>
        // Check theme on load
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            width: 100vw;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--body-bg);
            background-image: var(--body-gradient);
            color: var(--primary);
            padding: 100px 20px 40px; /* Padding top for navbar */
            overflow-x: hidden;
            transition: background 0.5s ease, color 0.5s ease;
            background-attachment: fixed;
            position: relative;
        }

        /* ---- Floating blobs for depth ---- */
        .blob {
            position: fixed; border-radius: 50%; filter: blur(80px);
            opacity: 0.25; z-index: 0; pointer-events: none;
            animation: blobFloat 18s ease-in-out infinite alternate;
        }
        .blob-1 { width: 500px; height: 500px; background: var(--lilac); top: -10%; left: -10%; }
        .blob-2 { width: 400px; height: 400px; background: var(--earth); bottom: -10%; right: -5%; animation-delay: -6s; }
        .blob-3 { width: 300px; height: 300px; background: var(--cream); top: 50%; left: 60%; animation-delay: -12s; }

        @keyframes blobFloat {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -40px) scale(1.1); }
            100% { transform: translate(-20px, 20px) scale(0.95); }
        }

        /* --- NAVBAR --- */
        .top-nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            background: var(--nav-bg);
            backdrop-filter: blur(18px) saturate(1.3);
            -webkit-backdrop-filter: blur(18px) saturate(1.3);
            border-bottom: 1px solid var(--border-glass);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            z-index: 9999;
            transition: background 0.3s ease;
        }

        .nav-brand {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 8px 0;
            position: relative;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--primary);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 2px;
            background: var(--lilac);
            transition: all 0.3s ease;
        }

        .nav-links a:hover::after, .nav-links a.active::after {
            width: 100%;
        }

        /* --- CONTENT --- */
        .container {
            max-width: 1300px;
            width: 100%;
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 40px;
            z-index: 10;
            position: relative;
        }

        .glass-card {
            background: var(--bg-glass);
            backdrop-filter: blur(24px) saturate(1.4);
            -webkit-backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius);
            padding: 40px;
            box-shadow: var(--shadow);
            transition: transform 0.4s ease, box-shadow 0.4s ease, background 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* Developer Profile Section */
        .profile-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            animation: fadeInUp 0.8s ease-out;
        }

        .profile-image-container {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            padding: 8px;
            background: linear-gradient(135deg, #fff, rgba(255,255,255,0.2));
            margin-bottom: 35px; /* Increased to fit the centered badge */
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            position: relative;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid transparent;
            transition: transform 0.5s ease;
        }

        .profile-image-container:hover .profile-image {
            transform: scale(1.08) rotate(3deg);
        }

        .dev-badge {
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--btn-accent);
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(139, 111, 71, 0.4);
            white-space: nowrap;
        }

        .profile-name {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
            color: var(--primary);
        }

        .profile-email {
            font-size: 15px;
            color: var(--text-muted);
            margin-bottom: 25px;
            font-weight: 300;
        }

        .profile-contact {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--pill-bg);
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--pill-text);
            font-weight: 500;
        }
        .profile-contact:hover {
            background: var(--lilac-soft);
            color: var(--primary);
        }

        /* Features Section */
        .features-section {
            animation: fadeInRight 1s ease-out;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--primary);
        }

        .section-title i {
            color: var(--lilac);
            font-size: 20px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .feature-item {
            background: var(--item-bg);
            border-radius: 16px;
            padding: 20px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .feature-item:hover {
            background: var(--item-hover);
            transform: translateX(10px);
            border-color: var(--border-glass);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .feature-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: var(--lilac-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--lilac);
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .feature-text h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--primary);
        }

        .feature-text p {
            font-size: 14.5px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .tech-stack {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
            justify-content: center;
        }

        .tech-tag {
            background: var(--pill-bg);
            color: var(--pill-text);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid var(--border-glass);
            transition: all 0.3s;
        }

        .tech-tag:hover {
            background: var(--lilac-soft);
            color: var(--primary);
            border-color: var(--lilac);
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }
            .top-nav {
                padding: 0 20px;
            }
        }
    </style>
</head>
<body>
    
    <!-- Floating background blobs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- NAVBAR -->
    <nav class="top-nav">
        <div class="nav-brand">Pemetaan Coffee</div>
        <div class="nav-links">
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ route('map') }}" class="{{ request()->routeIs('map') ? 'active' : '' }}">Map</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <button id="btn-theme" class="btn-theme" title="Toggle Theme"><i class="fa-solid fa-moon"></i></button>
        </div>
    </nav>

    <div class="container">
        <!-- Developer Profile -->
        <div class="glass-card profile-section">
            <div class="profile-image-container">
                <img src="{{ asset('images/developer.png') }}" onerror="this.src='https://ui-avatars.com/api/?name=Samalona+Simanjuntak&background=d35400&color=fff&size=200'" alt="Samalona Simanjuntak" class="profile-image">
                <!-- Developer badge is now centered below the image -->
                <div class="dev-badge">Developer</div>
            </div>
            
            <h1 class="profile-name">Samalona Simanjuntak</h1>
            <p class="profile-role">Mahasiswa & Pengembang</p>
            
            <a href="mailto:samalonasimanjuntak@students.polmed.ac.id" class="profile-contact">
                <i class="fa-solid fa-envelope"></i>
                samalonasimanjuntak@students.polmed.ac.id
            </a>

            <div style="margin-top: 30px; width: 100%; border-top: 1px solid var(--border-glass); padding-top: 20px;">
                <h3 style="font-size: 16px; margin-bottom: 10px; color: var(--primary);">Tech Stack Proyek:</h3>
                <div class="tech-stack">
                    <span class="tech-tag"><i class="fa-brands fa-laravel" style="color: #ff2d20;"></i> Laravel</span>
                    <span class="tech-tag"><i class="fa-solid fa-leaf" style="color: #4CAF50;"></i> Leaflet.js</span>
                    <span class="tech-tag"><i class="fa-brands fa-css3-alt" style="color: #2965f1;"></i> CSS3</span>
                    <span class="tech-tag"><i class="fa-brands fa-js" style="color: #f7df1e;"></i> JavaScript</span>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="features-section">
            <div class="glass-card">
                <h2 class="section-title"><i class="fa-solid fa-bolt"></i> Fitur Cepat</h2>
                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-location-crosshairs"></i></div>
                        <h3 class="feature-title">Lokasi Terdekat</h3>
                        <p class="feature-desc">Temukan gerai kopi terdekat dari posisimu saat ini secara instan dan akurat.</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                        <h3 class="feature-title">Pencarian Cerdas</h3>
                        <p class="feature-desc">Cari nama outlet atau kecamatan dengan fitur auto-complete yang responsif.</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-filter"></i></div>
                        <h3 class="feature-title">Filter Interaktif</h3>
                        <p class="feature-desc">Saring tampilan peta untuk hanya melihat Kopi Kenangan atau Fore Coffee.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card">
                <h2 class="section-title"><i class="fa-solid fa-star"></i> Fitur Unggulan</h2>
                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #27ae60, #2ecc71);"><i class="fa-solid fa-map-location-dot"></i></div>
                        <h3 class="feature-title">Pemetaan Presisi</h3>
                        <p class="feature-desc">Terintegrasi dengan Leaflet.js untuk pengalaman pemetaan interaktif tingkat lanjut.</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon" style="background: linear-gradient(135deg, #8e44ad, #9b59b6);"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                        <h3 class="feature-title">Desain Glassmorphism</h3>
                        <p class="feature-desc">Antarmuka estetik, modern, dan kekinian yang tetap menjaga aspek <i>user friendly</i>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Theme Toggle Logic
    document.getElementById('btn-theme').addEventListener('click', function() {
        let isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        let icon = this.querySelector('i');
        
        if (isDark) {
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        } else {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }
    });

    // Check icon state on load
    document.addEventListener('DOMContentLoaded', () => {
        let isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        let icon = document.querySelector('#btn-theme i');
        if (isDark) {
            icon.classList.replace('fa-moon', 'fa-sun');
        }
    });
</script>
</body>
</html>
