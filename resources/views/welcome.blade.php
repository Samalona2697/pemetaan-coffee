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
    {{-- Apply stored theme before paint to avoid flash of unstyled content --}}
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="welcome-body">
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
        // Staggered scroll reveal
        document.addEventListener('DOMContentLoaded', () => {
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
        });
    </script>
</body>
</html>
