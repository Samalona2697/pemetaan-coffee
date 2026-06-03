<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemetaan Coffee Medan</title>
    <link rel="icon" href="https://laravel.com/img/favicon/favicon-32x32.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }

        body {
            width: 100vw; overflow-x: hidden;
            background: linear-gradient(135deg, rgba(255, 248, 231, 0.85) 0%, rgba(184, 162, 208, 0.65) 50%, rgba(139, 111, 71, 0.75) 100%), url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=2000&auto=format&fit=crop') no-repeat center center/cover !important;
            background-attachment: fixed !important;
        }

        :root[data-theme="dark"] body {
            background: linear-gradient(135deg, rgba(15, 13, 18, 0.92) 0%, rgba(50, 40, 65, 0.82) 50%, rgba(30, 20, 15, 0.92) 100%), url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=2000&auto=format&fit=crop') no-repeat center center/cover !important;
            background-attachment: fixed !important;
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

        /* ---- NAVBAR ---- */
        .top-nav {
            position: fixed; top: 0; left: 0; width: 100%; height: 70px;
            background: var(--nav-bg);
            backdrop-filter: blur(18px) saturate(1.3);
            -webkit-backdrop-filter: blur(18px) saturate(1.3);
            border-bottom: 1px solid var(--border-glass);
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 40px; z-index: 9999;
            transition: all 0.4s ease;
        }
        .nav-brand { font-size: 22px; font-weight: 800; color: var(--primary); letter-spacing: 0.3px; }
        .nav-links { display: flex; gap: 26px; align-items: center; }
        .nav-links a {
            color: var(--text-muted); text-decoration: none; font-size: 15px; font-weight: 600;
            transition: all 0.3s ease; padding: 8px 0; position: relative;
        }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }
        .nav-links a::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 0%; height: 2px; background: var(--lilac);
            transition: width 0.3s ease; border-radius: 2px;
        }
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }

        /* ---- HERO ---- */
        .hero-section {
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            padding: 110px 20px 80px; position: relative; z-index: 1;
        }

        .hero-card {
            background: var(--bg-glass);
            backdrop-filter: blur(24px) saturate(1.4);
            -webkit-backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius);
            padding: 55px 50px; max-width: 620px; width: 100%;
            text-align: center; box-shadow: var(--shadow);
            animation: heroEnter 1s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative; overflow: hidden;
        }
        .hero-card::before {
            content: ''; position: absolute; top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: conic-gradient(from 180deg, transparent, var(--lilac-soft), transparent, rgba(139, 111, 71, 0.05), transparent);
            animation: shimmer 8s linear infinite;
            pointer-events: none;
        }
        @keyframes shimmer { to { transform: rotate(360deg); } }
        @keyframes heroEnter {
            from { opacity: 0; transform: translateY(40px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .hero-inner { position: relative; z-index: 2; }

        .logo-container {
            display: flex; align-items: center; justify-content: center;
            gap: 24px; margin-bottom: 32px;
        }
        .brand-logo {
            width: 110px; height: 62px; object-fit: contain;
            background: white; border-radius: 14px; padding: 8px 14px;
            box-shadow: 0 4px 16px rgba(80, 60, 40, 0.08);
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
        }
        .brand-logo:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 10px 28px rgba(80, 60, 40, 0.14);
        }

        .hero-card h1 {
            font-size: 2.7rem; font-weight: 800; margin-bottom: 18px; line-height: 1.15;
            background: linear-gradient(135deg, var(--primary), var(--earth));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        :root[data-theme="dark"] .hero-card h1 {
            background: linear-gradient(135deg, var(--cream), var(--lilac));
            -webkit-background-clip: text; background-clip: text;
        }

        .hero-desc {
            font-size: 1.05rem; font-weight: 400; margin-bottom: 36px;
            color: var(--text-muted); line-height: 1.7;
        }

        /* ---- STATS PANEL ---- */
        .hero-container {
            display: flex;
            align-items: stretch;
            justify-content: center;
            gap: 40px;
            max-width: 1150px;
            width: 100%;
            z-index: 2;
        }

        .stats-panel {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
        }

        .stat-card {
            background: var(--bg-glass);
            backdrop-filter: blur(24px) saturate(1.4);
            -webkit-backdrop-filter: blur(24px) saturate(1.4);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            animation: heroEnter 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            width: 330px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-card:nth-child(1) { animation-delay: 0.2s; }
        .stat-card:nth-child(2) { animation-delay: 0.4s; }

        .stat-value {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 12px;
            background: linear-gradient(135deg, var(--primary), var(--earth));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        :root[data-theme="dark"] .stat-value {
            background: linear-gradient(135deg, var(--cream), var(--lilac));
            -webkit-background-clip: text;
            background-clip: text;
        }

        .stat-label {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-glass);
        }
        
        .stat-label img {
            height: 24px;
            width: auto;
            border-radius: 4px;
            object-fit: contain;
            background: white;
            padding: 2px 6px;
        }

        .stat-split {
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .stat-split .stat-value {
            font-size: 2.2rem;
            margin-bottom: 4px;
        }

        .stat-sub {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-extra {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed var(--border-glass);
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .extra-item i {
            color: var(--primary);
            margin-right: 5px;
        }

        .explore-btn {
            display: inline-flex; align-items: center; gap: 10px;
            background: var(--btn-accent); color: white;
            text-decoration: none; padding: 15px 38px;
            border-radius: 50px; font-size: 1rem; font-weight: 600;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative; overflow: hidden;
            box-shadow: 0 6px 20px rgba(139, 111, 71, 0.2);
            letter-spacing: 0.3px;
        }
        .explore-btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 12px 32px rgba(139, 111, 71, 0.3);
        }
        .explore-btn::after {
            content: ""; position: absolute; top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.6s ease;
        }
        .explore-btn:hover::after { left: 100%; }

        /* ---- CONTENT ---- */
        .content-section {
            padding: 20px 20px 80px; max-width: 1020px;
            margin: 0 auto; position: relative; z-index: 1;
        }

        .section-header {
            text-align: center; margin-bottom: 40px;
        }
        .section-tag {
            display: inline-block; padding: 6px 18px; border-radius: 50px;
            font-size: 12px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; margin-bottom: 14px;
            background: var(--lilac-soft); color: var(--lilac);
            border: 1px solid var(--border-glass);
        }
        .section-title {
            font-size: 28px; font-weight: 800; color: var(--primary);
        }

        .trend-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 80px;
        }

        .trend-card {
            padding: 36px 28px; text-align: center;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            cursor: default;
        }
        .trend-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(80, 60, 40, 0.1) !important;
        }

        .trend-icon-wrap {
            width: 68px; height: 68px; border-radius: 18px;
            background: var(--lilac-soft);
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 22px; font-size: 26px; color: var(--lilac);
            border: 1px solid var(--border-glass);
            transition: all 0.4s ease;
        }
        .trend-card:hover .trend-icon-wrap {
            background: var(--lilac);
            color: white;
            transform: scale(1.08) rotate(-5deg);
            box-shadow: 0 6px 20px rgba(184, 162, 208, 0.25);
        }

        .trend-card h3 { font-size: 20px; margin-bottom: 12px; font-weight: 700; }
        .trend-card p { font-size: 14px; line-height: 1.7; margin-bottom: 0; color: var(--text-muted); }

        /* ---- BRAND SHOWCASE ---- */
        .showcase-grid { display: flex; flex-direction: column; gap: 24px; }

        .showcase-card {
            display: flex; align-items: center; padding: 28px 30px; gap: 30px;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease;
            cursor: default;
        }
        .showcase-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(80, 60, 40, 0.1) !important;
        }

        .showcase-logo { flex: 0 0 auto; }
        .showcase-logo img {
            width: 110px; height: 65px; border-radius: 14px;
            object-fit: contain; background: white; padding: 8px 14px;
            box-shadow: 0 4px 14px rgba(80, 60, 40, 0.06);
            transition: transform 0.3s ease;
        }
        .showcase-card:hover .showcase-logo img {
            transform: scale(1.05);
        }

        .showcase-info { flex: 1; }
        .showcase-info h3 { font-size: 19px; font-weight: 700; margin-bottom: 6px; }

        .tag {
            display: inline-block; padding: 5px 14px; border-radius: 50px;
            font-size: 11px; font-weight: 700; color: white;
            margin-bottom: 12px; letter-spacing: 0.4px;
        }
        .tag-kopken { background: var(--earth); }
        .tag-fore { background: var(--lilac); }

        .showcase-info p { font-size: 14px; color: var(--text-muted); line-height: 1.7; margin-bottom: 0; }

        /* ---- FOOTER ---- */
        .site-footer {
            text-align: center; padding: 24px; font-size: 13px;
            color: var(--text-muted); font-weight: 500;
            border-top: 1px solid var(--border-glass);
            background: var(--bg-glass);
            backdrop-filter: blur(12px);
            position: relative; z-index: 1;
        }

        /* ---- SCROLL REVEAL ---- */
        .reveal {
            opacity: 0; transform: translateY(35px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 900px) {
            .top-nav { padding: 0 20px; }
            .nav-brand { font-size: 18px; }
            .nav-links { gap: 14px; }
            .blob { display: none; }
            .hero-container {
                flex-direction: column;
                align-items: center;
            }
            .stats-panel {
                flex-direction: row;
                width: 100%;
                justify-content: center;
            }
            .stat-card {
                width: auto;
                flex: 1;
                max-width: 310px;
                padding: 20px;
            }
            .stat-value { font-size: 2.5rem; }
        }
        @media (max-width: 768px) {
            .trend-grid { grid-template-columns: 1fr; }
            .showcase-card { flex-direction: column; text-align: center; }
            .showcase-logo { margin-bottom: 5px; }
            .hero-card h1 { font-size: 2.1rem; }
            .hero-card { padding: 40px 28px; }
            .stats-panel { flex-direction: column; }
            .stat-card { max-width: 100%; }
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

    <!-- HERO -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-card">
                <div class="hero-inner">
                    <div class="logo-container">
                        <img src="{{ asset('images/logo-kopken.jpg') }}" onerror="this.src='https://via.placeholder.com/110x62?text=Kopken'" alt="Kopi Kenangan" class="brand-logo">
                        <img src="{{ asset('images/logo-fore.jpg') }}" onerror="this.src='https://via.placeholder.com/110x62?text=Fore'" alt="Fore Coffee" class="brand-logo">
                    </div>
                    <h1>Pemetaan Coffee<br>Medan</h1>
                    <p class="hero-desc">Platform interaktif eksplorasi gerai <strong>Kopi Kenangan</strong> dan <strong>Fore Coffee</strong> di Kota Medan. Temukan persebaran lokasi, bandingkan letaknya, serta lihat ketersediaan fasilitas <em>Dine-In</em>, <em>Takeaway</em>, maupun <em>Delivery</em> dari setiap gerai favoritmu.</p>
                    <a href="{{ route('map') }}" class="explore-btn">
                        <i class="fa-solid fa-map-location-dot"></i> Mulai Eksplorasi Peta
                    </a>
                </div>
            </div>

            <div class="stats-panel">
                <div class="stat-card">
                    <div class="stat-label">
                        <img src="{{ asset('images/logo-kopken.jpg') }}" onerror="this.style.display='none'" alt="Kopken">
                        Kopi Kenangan
                    </div>
                    <div class="stat-split">
                        <div>
                            <div class="stat-value">{{ $kopkenCount ?? 0 }}</div>
                            <div class="stat-sub">Gerai</div>
                        </div>
                        <div>
                            <div class="stat-value">
                                <span style="font-size:1.2rem;color:#f39c12;vertical-align:middle;margin-right:2px;">★</span>
                                {{ number_format($kopkenRating ?? 0, 1) }}
                            </div>
                            <div class="stat-sub">Rating</div>
                        </div>
                    </div>
                    <div class="stat-extra">
                        <div class="extra-item" title="Tersedia layanan Dine-In"><i class="fa-solid fa-mug-saucer"></i> Dine-In</div>
                        <div class="extra-item" title="Tersedia layanan Takeaway/Delivery"><i class="fa-solid fa-motorcycle"></i> Delivery</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">
                        <img src="{{ asset('images/logo-fore.jpg') }}" onerror="this.style.display='none'" alt="Fore">
                        Fore Coffee
                    </div>
                    <div class="stat-split">
                        <div>
                            <div class="stat-value">{{ $foreCount ?? 0 }}</div>
                            <div class="stat-sub">Gerai</div>
                        </div>
                        <div>
                            <div class="stat-value">
                                <span style="font-size:1.2rem;color:#f39c12;vertical-align:middle;margin-right:2px;">★</span>
                                {{ number_format($foreRating ?? 0, 1) }}
                            </div>
                            <div class="stat-sub">Rating</div>
                        </div>
                    </div>
                    <div class="stat-extra">
                        <div class="extra-item" title="Tersedia layanan Dine-In"><i class="fa-solid fa-mug-saucer"></i> Dine-In</div>
                        <div class="extra-item" title="Tersedia layanan Takeaway/Delivery"><i class="fa-solid fa-motorcycle"></i> Delivery</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT -->
    <section class="content-section">

        <div class="section-header reveal">
            <span class="section-tag">Insight</span>
            <div class="section-title">Budaya Kopi di Medan</div>
        </div>

        <div class="trend-grid">
            <div class="trend-card glass-panel reveal">
                <div class="trend-icon-wrap"><i class="fa-solid fa-mug-hot"></i></div>
                <h3>Lonjakan Penikmat Kopi</h3>
                <p>Peminat kopi susu kekinian di Medan meningkat drastis hingga <b>40%</b> dalam beberapa tahun terakhir. Ngopi kini telah menjadi budaya dan gaya hidup urban yang sangat melekat di masyarakat Medan.</p>
            </div>
            <div class="trend-card glass-panel reveal">
                <div class="trend-icon-wrap"><i class="fa-solid fa-laptop-code"></i></div>
                <h3>Tren WFC &amp; Hangout</h3>
                <p>Kalangan milenial dan Gen Z mendominasi konsumsi harian. Kedai kopi kini beralih fungsi menjadi ruang produktivitas untuk <em>Work From Cafe</em> (WFC) dan titik kumpul paling ideal bersama teman.</p>
            </div>
        </div>

        <div class="section-header reveal" style="margin-top: 10px;">
            <span class="section-tag">Best Seller</span>
            <div class="section-title">Menu Paling Sering Dikonsumsi</div>
        </div>

        <div class="showcase-grid">
            <div class="showcase-card glass-panel reveal">
                <div class="showcase-logo">
                    <img src="{{ asset('images/logo-kopken.jpg') }}" onerror="this.src='https://via.placeholder.com/110x65?text=Kopken'" alt="Kopi Kenangan">
                </div>
                <div class="showcase-info">
                    <span class="tag tag-kopken">Best Seller Kopi Kenangan</span>
                    <h3>Kopi Kenangan Mantan</h3>
                    <p>Perpaduan kopi pekat dengan manisnya gula aren lokal asli menciptakan cita rasa otentik yang sangat digemari. Harganya yang sangat terjangkau menjadikannya kopi "wajib" bagi masyarakat menengah dan kalangan pekerja setiap harinya.</p>
                </div>
            </div>
            <div class="showcase-card glass-panel reveal">
                <div class="showcase-logo">
                    <img src="{{ asset('images/logo-fore.jpg') }}" onerror="this.src='https://via.placeholder.com/110x65?text=Fore'" alt="Fore Coffee">
                </div>
                <div class="showcase-info">
                    <span class="tag tag-fore">Best Seller Fore Coffee</span>
                    <h3>Aren &amp; Pandan Latte</h3>
                    <p>Varian <b>Aren Latte</b> dan racikan khas <b>Pandan Latte</b> dari Fore menjadi primadona. Menggunakan 100% biji kopi Arabika dengan sentuhan <em>flavor</em> yang lembut. Fore sangat disukai oleh anak muda yang mencari pengalaman <em>ngopi</em> estetik.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        &copy; 2026 Pemetaan Coffee Medan &mdash; Dikembangkan oleh Samalona Simanjuntak
    </footer>

    <script>
        // Theme Toggle
        document.getElementById('btn-theme').addEventListener('click', function() {
            let isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            let icon = this.querySelector('i');
            if (isDark) {
                document.documentElement.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
                icon.classList.replace('fa-sun', 'fa-moon');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                icon.classList.replace('fa-moon', 'fa-sun');
            }
        });
        document.addEventListener('DOMContentLoaded', () => {
            if (document.documentElement.getAttribute('data-theme') === 'dark') {
                document.querySelector('#btn-theme i').classList.replace('fa-moon', 'fa-sun');
            }
        });

        // Staggered scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach((el, i) => {
            el.style.transitionDelay = `${i * 80}ms`;
            observer.observe(el);
        });
    </script>
</body>
</html>
