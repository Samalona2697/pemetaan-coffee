<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pemetaan Coffee Medan</title>
    <!-- Laravel Favicon -->
    <link rel="icon" href="https://laravel.com/img/favicon/favicon-32x32.png" type="image/png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #d35400;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            /* Aesthetic background */
            background: linear-gradient(135deg, rgba(44, 62, 80, 0.8), rgba(211, 84, 0, 0.6)), url('https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=2000&auto=format&fit=crop') no-repeat center center/cover;
            color: white;
            position: relative;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 50px 40px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-out;
            position: relative;
            z-index: 10;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .brand-logo {
            width: 75px;
            height: 75px;
            object-fit: contain;
            background: white;
            border-radius: 50%;
            padding: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.1) rotate(5deg);
        }

        h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        p {
            font-size: 1.2rem;
            font-weight: 300;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        .explore-btn {
            display: inline-block;
            background: linear-gradient(90deg, #d35400, #e67e22);
            color: white;
            text-decoration: none;
            padding: 16px 40px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(211, 84, 0, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .explore-btn:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 25px rgba(211, 84, 0, 0.6);
        }

        .explore-btn:active {
            transform: translateY(1px);
        }

        /* Micro animation for button */
        .explore-btn::after {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: rgba(255,255,255,0.2);
            transition: all 0.4s ease;
        }

        .explore-btn:hover::after {
            left: 100%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="glass-card">
        <div class="logo-container">
            <img src="{{ asset('images/logo-kopken.jpg') }}" onerror="this.src='https://via.placeholder.com/80?text=Kopken'" alt="Kopi Kenangan" class="brand-logo">
            <img src="{{ asset('images/logo-fore.jpg') }}" onerror="this.src='https://via.placeholder.com/80?text=Fore'" alt="Fore Coffee" class="brand-logo">
        </div>
        <h1>Pemetaan Coffee<br>Medan</h1>
        <p>Platform interaktif eksplorasi gerai <strong>Kopi Kenangan</strong> dan <strong>Fore Coffee</strong> di Kota Medan. Temukan persebaran lokasi terdekat, bandingkan letaknya, serta lihat ketersediaan fasilitas <i>Dine-In</i>, <i>Takeaway</i>, maupun <i>Delivery</i> dari setiap gerai favoritmu secara aktual dan mudah.</p>
        <a href="{{ route('map') }}" class="explore-btn">Mulai Eksplorasi Peta</a>
    </div>
</body>
</html>
