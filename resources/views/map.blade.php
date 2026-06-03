<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemetaan Coffee Medan - Premium Mapping</title>

    <!-- Favicon -->
    <link rel="icon" href="https://laravel.com/img/favicon/favicon-32x32.png" type="image/png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    
    <!-- Custom CSS -->

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        #map {
            height: 100%;
            width: 100%;
            z-index: 1;
        }

        
        /* Glassmorphism Sidebar */
        #sidebar {
            position: absolute;
            top: 90px; /* Shifted for navbar */
            left: -400px;
            width: 360px;
            height: calc(100vh - 110px);
            background: var(--panel-bg-gradient);
            backdrop-filter: blur(18px) saturate(1.2);
            -webkit-backdrop-filter: blur(18px) saturate(1.2);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: left 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        #sidebar.show {
            left: 20px;
        }

        .sidebar-header {
            padding: 24px;
            background: linear-gradient(135deg, var(--sidebar-header-bg1) 0%, var(--sidebar-header-bg2) 100%);
            border-bottom: 1px solid var(--border-glass);
        }

        .sidebar-header h1 {
            font-size: 22px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.2;
        }

        .sidebar-header p {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 300;
        }

        .btn-about {
            position: absolute;
            top: 24px;
            right: 24px;
            color: var(--primary);
            font-size: 22px;
            transition: all 0.3s ease;
        }
        
        .btn-about:hover {
            transform: scale(1.15) rotate(5deg);
            color: #d35400;
        }

        /* Tabs */
        .tabs {
            display: flex;
            padding: 0 16px;
            margin-top: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .tab-btn {
            flex: 1;
            padding: 12px 0;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-muted);
            position: relative;
            transition: all 0.3s ease;
        }

        .tab-btn::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        .tab-btn.active::after {
            width: 100%;
        }

        .tab-btn.active.semua-tab {
            color: var(--primary);
        }
        .tab-btn.active.semua-tab::after {
            background: var(--primary);
        }

        .tab-btn.active.kopken-tab {
            color: var(--kopken);
        }
        .tab-btn.active.kopken-tab::after {
            background: var(--kopken);
        }
        
        .tab-btn.active.fore-tab {
            color: var(--fore);
        }
        .tab-btn.active.fore-tab::after {
            background: var(--fore);
        }

        .tab-btn:hover {
            color: var(--primary);
        }

        /* List styling */
        .coffee-list {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
        }

        /* Scrollbar customizing */
        .coffee-list::-webkit-scrollbar {
            width: 6px;
        }
        .coffee-list::-webkit-scrollbar-track {
            background: transparent;
        }
        .coffee-list::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .coffee-item {
            background: var(--item-bg);
            border: 1px solid var(--border-glass);
            border-radius: 14px;
            padding: 14px;
            margin-bottom: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
            border-left: 4px solid transparent;
            opacity: 0;
            transform: translateY(20px);
            animation: slideInUp 0.5s forwards;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .item-img {
            width: 65px;
            height: 65px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .item-info {
            flex: 1;
            min-width: 0;
        }

        .coffee-item:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 25px rgba(0,0,0,0.4);
            background: var(--item-hover);
        }

        .coffee-item.kopken-item:hover {
            border-left-color: var(--kopken);
        }

        .coffee-item.fore-item:hover {
            border-left-color: var(--fore);
        }

        .item-name {
            font-weight: 600;
            color: var(--primary);
            font-size: 16px;
            margin-bottom: 4px;
        }

        .item-type {
            font-size: 12px;
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--pill-bg);
            color: var(--pill-text);
            margin-bottom: 8px;
            border: 1px solid var(--border-glass);
        }

        .item-address {
            font-size: 13px;
            color: var(--text-muted);
            display: -webkit-box;
            -webkit-line-clamp: 2px;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        /* Custom Leaflet Popup */
        .leaflet-popup-content-wrapper {
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.25);
            background: var(--popup-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-glass);
            color: var(--primary);
            animation: popupFadeIn 0.4s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        
        .leaflet-popup-tip {
            background: var(--popup-bg);
        }

        .leaflet-popup-content {
            margin: 0;
            width: 280px !important;
            font-family: 'Outfit', sans-serif;
            color: var(--primary);
        }

        .popup-img-wrapper {
            width: 100%;
            height: 150px;
            overflow: hidden;
            position: relative;
        }

        .popup-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .popup-img-wrapper:hover .popup-img {
            transform: scale(1.05);
        }

        .popup-body {
            padding: 16px;
        }

        .popup-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .popup-address {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .popup-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .info-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            background: var(--pill-bg);
            padding: 6px 8px;
            border-radius: 8px;
            color: var(--pill-text);
            font-weight: 500;
            border: 1px solid var(--border-glass);
        }

        .info-pill i.yes { color: var(--fore); }
        .info-pill i.no { color: #e74c3c; }

        .leaflet-popup-tip-container {
            margin-top: -1px;
        }

        /* ================= SEARCH BOX ================= */
        #search-box {
            position: absolute;
            top: 90px; /* Shifted for navbar */
            left: 76px;
            z-index: 1200;
            width: 300px;
            background: var(--search-bg);
            backdrop-filter: blur(10px);
            border-radius: 50px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            border: 1px solid var(--border-glass);
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        #search-box.shifted {
            left: 448px; /* Shifted to be right next to the toggle-sidebar */
        }

        #search-box:hover {
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }

        #search-box i.fa-search {
            color: #888;
            font-size: 14px;
        }

        #search-box .clear-search {
            cursor: pointer;
            color: #aaa;
            font-size: 13px;
            transition: color 0.2s;
        }
        #search-box .clear-search:hover {
            color: #e74c3c;
        }

        #search-input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            background: transparent;
            color: var(--primary);
            font-family: 'Outfit', sans-serif;
        }

        #search-input::placeholder {
            color: var(--text-muted);
        }

        /* Search Results Dropdown */
        #search-results {
            position: absolute;
            top: 52px;
            left: 0;
            width: 100%;
            max-height: 320px;
            overflow-y: auto;
            background: var(--popup-bg);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0,0,0,0.5);
            border: 1px solid var(--border-glass);
            display: none;
            z-index: 1201;
        }

        #search-results::-webkit-scrollbar { width: 5px; }
        #search-results::-webkit-scrollbar-thumb { background: rgba(150,150,150,0.2); border-radius: 10px; }

        .search-result-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid var(--border-glass);
            transition: background 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-result-item:last-child { border-bottom: none; }
        .search-result-item:hover { background: var(--item-hover); }

        .search-result-item .sr-icon {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: white; flex-shrink: 0;
        }
        .search-result-item .sr-icon.kopken { background: var(--kopken); }
        .search-result-item .sr-icon.fore { background: var(--fore); }

        .search-result-item .sr-info { flex: 1; }
        .search-result-item .sr-name { font-weight: 600; font-size: 14px; color: var(--primary); }
        .search-result-item .sr-addr { font-size: 12px; color: var(--text-muted); margin-top: 2px; }

        .search-no-result {
            padding: 20px 16px;
            text-align: center;
            color: var(--text-muted);
            font-size: 14px;
        }

        /* ================= NEAREST BUTTON ================= */
        #btn-nearest {
            position: absolute;
            bottom: 30px;
            left: 40px; 
            z-index: 1200;

            background: linear-gradient(135deg, #2C3E50, #34495e);
            color: white;

            border: none;
            width: 55px;
            height: 55px;
            border-radius: 50%;

            font-size: 20px;
            cursor: pointer;

            box-shadow: 0 8px 20px rgba(0,0,0,0.2);

            display: flex;
            align-items: center;
            justify-content: center;

            transition: all 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        #btn-nearest.shifted {
            left: 400px;
        }

        #btn-nearest:hover {
            transform: scale(1.1) rotate(10deg);
        }

        /* ================= SIDEBAR BUTTON ================= */
        #toggle-sidebar {
            position: absolute;
            top: 94px; /* Shifted for navbar */
            left: 20px;
            z-index: 1300;
            background: var(--search-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-glass);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            cursor: pointer;
            font-size: 18px;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        #toggle-sidebar.shifted {
            left: 392px;
        }

        #toggle-sidebar:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 16px rgba(0,0,0,0.16);
        }

        /* ================= LEAFLET CONTROL FIX ================= */
        .leaflet-top.leaflet-left {
            left: auto !important;
            right: 20px;
            top: 90px; /* Shifted for navbar */
        }

        /* ================= SEARCH FOCUS EFFECT ================= */
        #search-box:focus-within {
            border-color: var(--kopken);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            #search-box {
                left: 76px;
                width: calc(100vw - 100px);
                padding: 8px 12px;
            }
            #search-box.shifted {
                left: 76px; /* Hide or keep same on mobile */
            }
            #toggle-sidebar.shifted {
                left: 20px;
            }
            #btn-nearest {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
            #btn-nearest.shifted {
                left: 40px; /* Don't shift on mobile */
            }
        }
                /* Animations */
                @keyframes popupFadeIn {
                    from { opacity: 0; transform: translateY(10px) scale(0.95); }
                    to { opacity: 1; transform: translateY(0) scale(1); }
                }

                @keyframes slideInUp {
                    from { opacity: 0; transform: translateY(20px); }
                    to { opacity: 1; transform: translateY(0); }
                }

                /* Right Detail Panel */
                #right-panel {
                    position: absolute;
                    top: 90px; /* Shifted for navbar */
                    right: -400px; /* start off-screen right */
                    width: 360px;
                    height: calc(100vh - 110px);
                    background: var(--panel-bg-gradient);
                    backdrop-filter: blur(20px);
                    -webkit-backdrop-filter: blur(20px);
                    border: 1px solid var(--border-glass);
                    border-radius: var(--radius);
                    box-shadow: var(--shadow);
                    z-index: 1000;
                    display: flex;
                    flex-direction: column;
                    overflow-y: auto;
                    transition: right 0.6s cubic-bezier(0.2, 0.8, 0.2, 1);
                }

                #right-panel.show {
                    right: 20px;
                }

                .close-right {
                    position: absolute;
                    top: 16px;
                    right: 16px;
                    background: rgba(0,0,0,0.3);
                    border: none;
                    width: 32px;
                    height: 32px;
                    border-radius: 50%;
                    cursor: pointer;
                    z-index: 10;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    transition: all 0.3s;
                }
                .close-right:hover {
                    background: #e74c3c;
                }

                .detail-hero {
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                }

                .detail-content {
                    padding: 24px;
                }

                .detail-title {
                    font-size: 22px;
                    font-weight: 700;
                    color: var(--primary);
                    margin-bottom: 8px;
                    margin-top: -10px;
                    line-height: 1.2;
                }

                .detail-badge {
                    display: inline-block;
                    padding: 4px 12px;
                    border-radius: 20px;
                    font-size: 13px;
                    font-weight: 600;
                    margin-bottom: 16px;
                }

                .attr-box {
                    background: var(--attr-box-bg);
                    border-radius: 12px;
                    padding: 16px;
                    margin-bottom: 12px;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
                    border: 1px solid var(--border-glass);
                }

                .attr-box h4 {
                    font-size: 12px;
                    color: var(--text-muted);
                    margin-bottom: 6px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    font-weight: 600;
                }

                .attr-box p {
                    font-size: 14px;
                    color: var(--primary);
                    font-weight: 500;
                    line-height: 1.5;
                }

                .rating-box {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    font-size: 18px;
                    font-weight: 700;
                    color: var(--primary);
                }
                .rating-box i {
                    color: #f1c40f;
                }

                .btn-detail {
                    margin-top: 14px;
                    width: 100%;
                    padding: 10px 16px;
                    background: var(--btn-accent);
                    color: white;
                    border: none;
                    border-radius: 10px;
                    cursor: pointer;
                    font-weight: 600;
                    font-size: 14px;
                    font-family: 'Outfit', sans-serif;
                    transition: all 0.3s ease;
                    letter-spacing: 0.3px;
                }
                .btn-detail:hover {
                    background: var(--btn-accent-hover);
                    transform: translateY(-1px);
                    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                }

                /* Map controls adjustment */
                .leaflet-top.leaflet-left {
                    left: auto;
                    right: 20px;
                    top: 90px; /* Shifted for navbar */
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
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
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
            background: var(--lilac, #b8a2d0); /* Lilac accent */
            transition: all 0.3s ease;
        }

        .nav-links a:hover::after, .nav-links a.active::after {
            width: 100%;
        }


        @media (max-width: 900px) {
            .top-nav { padding: 0 20px; }
            .nav-brand { font-size: 18px; }
            .nav-links { gap: 15px; }
        }

    </style>
    <script>
        // Check theme on load to prevent flash
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
</head>

<body style="height: 100vh; width: 100vw; overflow: hidden;">

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

<button id="toggle-sidebar"><i class="fa-solid fa-bars"></i></button>

<div id="search-box">
    <i class="fa fa-search"></i>
    <input type="text" id="search-input" placeholder="Cari outlet (nama / kecamatan)..." autocomplete="off">
    <i class="fa fa-times clear-search" id="clear-search" style="display:none;"></i>
    <div id="search-results"></div>
</div>

<button id="btn-nearest" title="Cari outlet terdekat dari lokasi saya">
    <i class="fa-solid fa-location-crosshairs"></i>
</button>

<div id="sidebar" class="glass-panel">
    <div class="sidebar-header" style="position: relative;">
        <h1>Pemetaan Coffee</h1>
        <p>Jelajahi Kopi Kenangan & Fore Coffee di wilayah Medan</p>
    </div>
    
    <div class="tabs">
        <button class="tab-btn active semua-tab" onclick="switchTab('semua')">Semua</button>
        <button class="tab-btn kopken-tab" onclick="switchTab('kopken')">Kopi Kenangan</button>
        <button class="tab-btn fore-tab" onclick="switchTab('fore')">Fore Coffee</button>
    </div>

    <div id="item-list" class="coffee-list">
        <!-- JS will populate list here -->
    </div>
</div>

<div id="right-panel">
    <button class="close-right" onclick="closeDetail()"><i class="fa-solid fa-xmark"></i></button>
    <div id="detail-container"></div>
</div>

<div id="map"></div>
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // Initialize map
    var map = L.map('map', {
        zoomControl: true,
        // Optional: use a cleaner modern tile set like CartoDB Positron
    }).setView([3.5952, 98.6722], 13);
    
    // Move zoom control to bottom right for better aesthetics
    map.zoomControl.setPosition('bottomright');

    // Add map style and store reference
    let isDarkTheme = document.documentElement.getAttribute('data-theme') === 'dark';
    let initialTileUrl = isDarkTheme 
        ? 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png'
        : 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png';
        
    if (isDarkTheme) {
        document.querySelector('#btn-theme i').classList.replace('fa-moon', 'fa-sun');
    }

    var currentTileLayer = L.tileLayer(initialTileUrl, {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 20
    }).addTo(map);

    // Theme Toggle Logic
    document.getElementById('btn-theme').addEventListener('click', function() {
        let isDark = document.documentElement.getAttribute('data-theme') === 'dark';
        let icon = this.querySelector('i');
        
        map.removeLayer(currentTileLayer);
        
        if (isDark) {
            // Switch to Light
            document.documentElement.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
            currentTileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);
        } else {
            // Switch to Dark
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
            currentTileLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 20
            }).addTo(map);
        }
    });

    // Data dari Laravel
    var kopikenangan = @json($kopikenangan);
    var fore = @json($fore);

    // Store markers for active interplay
    var markers = [];
    var currentTab = 'semua';
    var userMarkerLayer = null;
    var userAccuracyCircle = null;

    // ===== TOGGLE SIDEBAR WITH BURGER + SEARCH SHIFT =====
    function updateShiftedElements() {
        let isOpen = document.getElementById('sidebar').classList.contains('show');
        document.getElementById('toggle-sidebar').classList.toggle('shifted', isOpen);
        document.getElementById('search-box').classList.toggle('shifted', isOpen);
        document.getElementById('btn-nearest').classList.toggle('shifted', isOpen);
    }

    // Show sidebar with animation on load
    setTimeout(() => {
        document.getElementById('sidebar').classList.add('show');
        updateShiftedElements();
    }, 300);

    document.getElementById('toggle-sidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
        updateShiftedElements();
    });

    // ===== NEAREST BUTTON =====
    document.getElementById('btn-nearest').addEventListener('click', function () {
        let btn = this;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';

        if (!navigator.geolocation) {
            alert("Browser tidak mendukung geolokasi.");
            btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i>';
            return;
        }

        navigator.geolocation.getCurrentPosition(function(position) {
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            // Remove old user marker
            if (userMarkerLayer) map.removeLayer(userMarkerLayer);
            if (userAccuracyCircle) map.removeLayer(userAccuracyCircle);

            // Accuracy circle
            userAccuracyCircle = L.circle([lat, lng], {
                radius: position.coords.accuracy,
                color: '#3498db',
                fillColor: '#3498db',
                fillOpacity: 0.08,
                weight: 1
            }).addTo(map);

            // User location marker
            userMarkerLayer = L.circleMarker([lat, lng], {
                radius: 10,
                color: '#fff',
                fillColor: '#3498db',
                fillOpacity: 1,
                weight: 3
            }).addTo(map).bindPopup('<b>📍 Lokasi Anda</b>').openPopup();

            map.flyTo([lat, lng], 14, { duration: 1.5 });

            // Fetch nearest outlets
            fetch(`/nearest?lat=${lat}&lng=${lng}`)
            .then(res => res.json())
            .then(data => {
                markers.forEach(m => map.removeLayer(m));
                markers = [];

                let gabungan = [
                    ...data.kopken.map(x => ({...x, brand: 'kopken'})),
                    ...data.fore.map(x => ({...x, brand: 'fore'}))
                ];
                gabungan.sort((a, b) => a.jarak - b.jarak);

                window.currentRenderedData = gabungan;

                // Update sidebar list
                let listContainer = document.getElementById('item-list');
                listContainer.innerHTML = '';

                gabungan.forEach((item, index) => {
                    let marker = L.marker([item.lat, item.lng]).addTo(map);
                    marker.bindPopup(createPopupContent(item, item.brand, index));
                    markers.push(marker);

                    let jarakKm = (item.jarak / 1000).toFixed(2);
                    let itemHTML = `
                        <div class="coffee-item ${item.brand}-item" onclick="flyToMarker(${index})" style="animation-delay: ${index * 0.05}s">
                            <div class="item-name">${item.nama}</div>
                            <div class="item-type">${item.tipe_outlet}</div>
                            <div class="item-address">${item.alamat}</div>
                            <div style="font-size:12px;color:#3498db;margin-top:4px;font-weight:600;">
                                <i class="fa-solid fa-location-arrow"></i> ${jarakKm} km
                            </div>
                        </div>
                    `;
                    listContainer.insertAdjacentHTML('beforeend', itemHTML);
                });

                if (markers[0]) {
                    setTimeout(() => markers[0].openPopup(), 1600);
                }

                btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i>';
            })
            .catch(() => {
                alert("Gagal mengambil data outlet terdekat.");
                btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i>';
            });

        }, function(error) {
            let msg = "Gagal mengambil lokasi.";
            if (error.code === 1) msg = "Akses lokasi ditolak. Izinkan lokasi di browser Anda.";
            if (error.code === 2) msg = "Lokasi tidak tersedia.";
            if (error.code === 3) msg = "Waktu permintaan lokasi habis.";
            alert(msg);
            btn.innerHTML = '<i class="fa-solid fa-location-crosshairs"></i>';
        }, { enableHighAccuracy: true, timeout: 10000 });
    });

    // Custom Icons (Optional if you want custom pins instead of default blue)
    var defaultIcon = new L.Icon.Default();

    function createPopupContent(data, brand, index) {
        // Fix Image Paths
        let imgPath = brand === 'kopken' ? `/images/kopken/${data.gambar}` : `/images/fore/${data.gambar}`;
        let fallbackImg = 'https://via.placeholder.com/260x140.png?text=Coffee+Shop';
        
        let getStatusIcon = (status) => {
            if (!status) return '<i class="fa-solid fa-xmark no" style="color: #e74c3c;"></i>';
            let s = status.toString().toLowerCase().trim();
            if (s === 'tersedia' || s === 'ya' || s === 'yes') {
                return '<i class="fa-solid fa-check yes" style="color: #2e8b57;"></i>'; // Hijau
            } else if (s === 'terbatas') {
                return '<i class="fa-solid fa-exclamation warning" style="color: #f1c40f;"></i>'; // Kuning
            } else {
                return '<i class="fa-solid fa-xmark no" style="color: #e74c3c;"></i>'; // Merah
            }
        };

        return `
            <div class="popup-img-wrapper">
                <img src="${imgPath}" onerror="this.src='${fallbackImg}'" class="popup-img" alt="${data.nama}">
            </div>
            <div class="popup-body">
                <div class="popup-title">${data.nama}</div>
                <div class="popup-address"><i class="fa-solid fa-location-dot" style="color: #e74c3c; margin-right:4px;"></i> 
                ${data.alamat}, ${data.kelurahan}, ${data.kecamatan}</div>
                ${data.jarak ? `
<div class="info-pill" style="grid-column: span 2; background:#eef2ff;">
    <i class="fa-solid fa-location-arrow"></i>
    ${(data.jarak/1000).toFixed(2)} km dari kamu
</div>
` : ''} 
                <div class="popup-info-grid">
                    <div class="info-pill">
                        ${getStatusIcon(data.dine_in)} Dine In
                    </div>
                    <div class="info-pill">
                        ${getStatusIcon(data.takeaway)} Takeaway
                    </div>
                    <div class="info-pill">
                        ${getStatusIcon(data.delivery)} Delivery
                    </div>
                    <div class="info-pill" style="justify-content:center; background: rgba(255,255,255,0.1); color: ${brand === 'kopken' ? 'var(--kopken)' : 'var(--fore)'}; font-weight:700;">
                        ${data.tipe_outlet}
                    </div>
                </div>
                <button class="btn-detail" onclick="openDetail(${index})">Lihat Detail Lengkap</button>
            </div>
        `;
    }

    function renderListAndMarkers(brand) {
        // Clear existing markers
        markers.forEach(m => map.removeLayer(m));
        markers = [];

        var listContainer = document.getElementById('item-list');
        listContainer.innerHTML = '';

        let dataToRender = [];
        if (brand === 'semua') {
            dataToRender = kopikenangan.map(item => Object.assign({}, item, {brand: 'kopken'})).concat(fore.map(item => Object.assign({}, item, {brand: 'fore'})));
        } else if (brand === 'kopken') {
            dataToRender = kopikenangan.map(item => Object.assign({}, item, {brand: 'kopken'}));
        } else if (brand === 'fore') {
            dataToRender = fore.map(item => Object.assign({}, item, {brand: 'fore'}));
        }

        window.currentRenderedData = dataToRender;

        dataToRender.forEach(function(data, index) {
            // Add Marker
            var marker = L.marker([data.lat, data.lng]).addTo(map);
            marker.bindPopup(createPopupContent(data, data.brand, index));
            markers.push(marker);

            // Populate Sidebar List
            let imgPath = data.brand === 'kopken' ? `/images/kopken/${data.gambar}` : `/images/fore/${data.gambar}`;
            let fallbackImg = 'https://via.placeholder.com/100x100.png?text=Coffee';
            
            var itemHTML = `
                <div class="coffee-item ${data.brand}-item" onclick="flyToMarker(${index})" style="animation-delay: ${index * 0.05}s">
                    <img src="${imgPath}" onerror="this.src='${fallbackImg}'" class="item-img" alt="${data.nama}">
                    <div class="item-info">
                        <div class="item-name">${data.nama}</div>
                        <div class="item-type">${data.tipe_outlet}</div>
                        <div class="item-address">${data.alamat}</div>
                    </div>
                </div>
            `;
            listContainer.insertAdjacentHTML('beforeend', itemHTML);
        });

        // Fit bounds if markers exist
        if(markers.length > 0) {
            var group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds(), { padding: [50, 50] });
        }
    }

    function flyToMarker(index) {
        if(markers[index]) {
            map.flyTo(markers[index].getLatLng(), 16, {
                duration: 1.5,
                easeLinearity: 0.25
            });
            // Open popup after flying
            setTimeout(() => {
                markers[index].openPopup();
                // On mobile, auto close sidebar so they can see map
                if(window.innerWidth < 768) {
                    document.getElementById('sidebar').classList.remove('show');
                }
            }, 1500);
        }
    }

    function getStatusOperasional(jamBuka, jamTutup) {
    if (!jamBuka || !jamTutup) {
        return '<span style="color:#888">Tidak diketahui</span>';
    }

    // Ambil hanya HH:MM dari "08:00:00"
    jamBuka = jamBuka.substring(0,5);
    jamTutup = jamTutup.substring(0,5);

    let now = new Date().toLocaleString("en-US", { timeZone: "Asia/Jakarta" });
    let waktu = new Date(now);
    let current = waktu.getHours() * 60 + waktu.getMinutes();
   
    let [bukaJam, bukaMenit] = jamBuka.split(':').map(Number);
    let [tutupJam, tutupMenit] = jamTutup.split(':').map(Number);

    let buka = bukaJam * 60 + bukaMenit;
    let tutup = tutupJam * 60 + tutupMenit;

    // Handle lewat tengah malam
    if (tutup < buka) {
        if (current >= buka || current <= tutup) {
            return '<span style="color:#2e8b57; font-weight:600;">● Buka</span>';
        }
    } else {
        if (current >= buka && current <= tutup) {
            return '<span style="color:#2e8b57; font-weight:600;">● Buka</span>';
        }
    }

    return '<span style="color:#e74c3c; font-weight:600;">● Tutup</span>';
}
    function openDetail(index) {
        let data = window.currentRenderedData[index];
        let brand = data.brand;
        let imgPath = brand === 'kopken' ? `/images/kopken/${data.gambar}` : `/images/fore/${data.gambar}`;
        let fallbackImg = 'https://via.placeholder.com/400x200.png?text=Coffee+Shop';
        
        let badgeColor = brand === 'kopken' ? 'var(--kopken)' : 'var(--fore)';
        let badgeBg = 'rgba(255,255,255,0.1)';
        
        // Cek rating (jika field belum ada di DB, akan bernilai undefined/null)
        let ratingVal = data.rating ? parseFloat(data.rating).toFixed(1) : 'Belum ada rating';
        let ratingStar = data.rating ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';

        let getStatusText = (status) => {
            if (!status) return '<span style="color:#e74c3c">✖ Tidak Tersedia</span>';
            let s = status.toString().toLowerCase().trim();
            if (s === 'tersedia' || s === 'ya' || s === 'yes') return '<span style="color:#2e8b57">✔ Tersedia</span>';
            if (s === 'terbatas') return '<span style="color:#f1c40f">⚠ Terbatas</span>';
            return '<span style="color:#e74c3c">✖ Tidak Tersedia</span>';
        };
        let jamBuka = data.jam_buka;
        let jamTutup = data.jam_tutup;

        // Fungsi cek buka/tutup

        let html = `
            <img src="${imgPath}" onerror="this.src='${fallbackImg}'" class="detail-hero" alt="${data.nama}">
            <div class="detail-content">
                <div class="detail-badge" style="background: ${badgeBg}; color: ${badgeColor}; border: 1px solid ${badgeColor}33">${data.tipe_outlet}</div>
                <h2 class="detail-title">${data.nama}</h2>
                
                <div class="attr-box mt-3">
                    <h4>Rating Pelanggan</h4>
                    <div class="rating-box">${ratingStar} ${ratingVal}</div>
                </div>

                <div class="attr-box">
                    <h4>Alamat Lengkap</h4>
                    <p><i class="fa-solid fa-location-dot" style="color: #e74c3c; margin-right:4px;"></i> ${data.alamat}, Kel. ${data.kelurahan}, Kec. ${data.kecamatan}</p>
                </div>
                <div class="attr-box">
                    <h4>Jam Operasional</h4>
                    <p>
                        <i class="fa-solid fa-clock" style="margin-right:6px;"></i>
                        ${jamBuka.substring(0,5)} - ${jamTutup.substring(0,5)} WIB
                    </p>
                    <p style="margin-top:6px;">
                        ${getStatusOperasional(jamBuka, jamTutup)}
                    </p>
                </div>
                <div class="attr-box">
                    <h4>Fasilitas Layanan</h4>
                    <div style="display:flex; flex-direction:column; gap:8px; margin-top:8px;">
                        <div><strong>Dine In:</strong><br> ${getStatusText(data.dine_in)}</div>
                        <div><strong>Takeaway:</strong><br> ${getStatusText(data.takeaway)}</div>
                        <div><strong>Delivery:</strong><br> ${getStatusText(data.delivery)}</div>
                    </div>
                </div>
            </div>
        `;
        document.getElementById('detail-container').innerHTML = html;
        document.getElementById('right-panel').classList.add('show');
        
        // On mobile, close left sidebar to give space
        if(window.innerWidth < 768) {
            document.getElementById('sidebar').classList.remove('show');
        }
    }

    function closeDetail() {
        document.getElementById('right-panel').classList.remove('show');
    }

    // Expose switchTab to global
    window.switchTab = function(brand) {
        if (currentTab === brand) return;
        currentTab = brand;

        // Update active tab styles
        document.querySelector('.semua-tab').classList.toggle('active', brand === 'semua');
        document.querySelector('.kopken-tab').classList.toggle('active', brand === 'kopken');
        document.querySelector('.fore-tab').classList.toggle('active', brand === 'fore');

        // Render data
        renderListAndMarkers(brand);
    }

    // Initial render
    renderListAndMarkers('semua');

    // ===== SEARCH FUNCTIONALITY =====
    var allOutlets = kopikenangan.map(item => Object.assign({}, item, {brand: 'kopken'}))
        .concat(fore.map(item => Object.assign({}, item, {brand: 'fore'})));

    var searchInput = document.getElementById('search-input');
    var searchResults = document.getElementById('search-results');
    var clearSearch = document.getElementById('clear-search');
    var searchTimeout = null;

    searchInput.addEventListener('input', function() {
        let query = this.value.trim().toLowerCase();
        clearSearch.style.display = query.length > 0 ? 'inline' : 'none';

        clearTimeout(searchTimeout);
        if (query.length < 2) {
            searchResults.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(() => {
            let results = allOutlets.filter(item => {
                return (item.nama && item.nama.toLowerCase().includes(query)) ||
                       (item.alamat && item.alamat.toLowerCase().includes(query)) ||
                       (item.kecamatan && item.kecamatan.toLowerCase().includes(query)) ||
                       (item.kelurahan && item.kelurahan.toLowerCase().includes(query)) ||
                       (item.tipe_outlet && item.tipe_outlet.toLowerCase().includes(query));
            });

            if (results.length === 0) {
                searchResults.innerHTML = '<div class="search-no-result"><i class="fa fa-coffee" style="margin-right:6px;"></i>Outlet tidak ditemukan</div>';
            } else {
                searchResults.innerHTML = results.slice(0, 10).map((item, i) => `
                    <div class="search-result-item" data-idx="${i}">
                        <div class="sr-icon ${item.brand}"><i class="fa-solid fa-mug-hot"></i></div>
                        <div class="sr-info">
                            <div class="sr-name">${item.nama}</div>
                            <div class="sr-addr">${item.kecamatan} · ${item.tipe_outlet}</div>
                        </div>
                    </div>
                `).join('');

                // Attach click events
                searchResults.querySelectorAll('.search-result-item').forEach((el, i) => {
                    el.addEventListener('click', () => {
                        let selected = results[i];
                        // Render just this outlet
                        markers.forEach(m => map.removeLayer(m));
                        markers = [];
                        window.currentRenderedData = [selected];

                        let marker = L.marker([selected.lat, selected.lng]).addTo(map);
                        marker.bindPopup(createPopupContent(selected, selected.brand, 0));
                        markers.push(marker);

                        map.flyTo([selected.lat, selected.lng], 17, { duration: 1.2 });
                        setTimeout(() => marker.openPopup(), 1300);

                        // Update sidebar list
                        let listContainer = document.getElementById('item-list');
                        listContainer.innerHTML = `
                            <div class="coffee-item ${selected.brand}-item" onclick="flyToMarker(0)" style="border-left-color: ${selected.brand === 'kopken' ? 'var(--kopken)' : 'var(--fore)'};">
                                <div class="item-name">${selected.nama}</div>
                                <div class="item-type">${selected.tipe_outlet}</div>
                                <div class="item-address">${selected.alamat}</div>
                            </div>
                        `;

                        searchResults.style.display = 'none';
                        searchInput.value = selected.nama;
                    });
                });
            }
            searchResults.style.display = 'block';
        }, 200);
    });

    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        searchResults.style.display = 'none';
        clearSearch.style.display = 'none';
        renderListAndMarkers(currentTab);
    });

    // Close search results on outside click
    document.addEventListener('click', function(e) {
        if (!document.getElementById('search-box').contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });

</script>

</body>
</html>