<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Card - {{ $restaurant->branch_name }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Noto+Sans:wght@400&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #c9a84c;
            --gold-light: #e0c872;
            --gold-dark: #a88a30;
            --card-green: #3d6b3d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .qr-card {
            width: 350px;
            background: linear-gradient(180deg, #4a7a4a 0%, #3d6b3d 50%, #2f5a2f 100%);
            border-radius: 20px;
            padding: 30px 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .qr-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at top, rgba(255,255,255,0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .platform-logo {
            width: 140px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 10px;
        }

        .platform-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--gold);
            letter-spacing: 3px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .divider {
            width: 80%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 0 auto 20px;
        }

        .restaurant-logo-container {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            border-radius: 50%;
            border: 3px solid var(--gold);
            overflow: hidden;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .restaurant-logo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .restaurant-logo-placeholder {
            font-family: 'Cormorant Garamond', serif;
            font-size: 48px;
            font-weight: 600;
            color: var(--card-green);
        }

        .qr-code-container {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .qr-code {
            width: 130px;
            height: 130px;
            object-fit: contain;
        }

        .qr-code-placeholder {
            width: 130px;
            height: 130px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 12px;
        }

        .multilang-text {
            margin-top: 15px;
        }

        .multilang-text p {
            color: var(--gold-light);
            font-size: 11px;
            line-height: 1.8;
            margin: 0;
        }

        .multilang-text p.ru {
            font-size: 12px;
            font-weight: 400;
        }

        .print-btn {
            margin-top: 30px;
            padding: 12px 40px;
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: #fff;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 15px rgba(201, 168, 76, 0.4);
        }

        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(201, 168, 76, 0.5);
        }

        .print-btn:active {
            transform: translateY(0);
        }

        .back-link {
            margin-top: 15px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #333;
        }

        /* Print styles */
        @media print {
            body {
                background: #fff;
                padding: 0;
                margin: 0;
            }

            .qr-card {
                box-shadow: none;
                margin: 0 auto;
            }

            .no-print {
                display: none !important;
            }

            @page {
                size: auto;
                margin: 10mm;
            }
        }
    </style>
</head>
<body>
    <div class="qr-card">
        {{-- Platform Logo --}}
        @if($platformLogo)
            <img src="{{ $platformLogo }}" alt="QR Gastronomic" class="platform-logo">
        @endif

        {{-- Platform Name --}}
        <div class="platform-name">QR Gastronomic</div>

        {{-- Divider --}}
        <div class="divider"></div>

        {{-- Restaurant Logo --}}
        <div class="restaurant-logo-container">
            @if($restaurantLogo)
                <img src="{{ $restaurantLogo }}" alt="{{ $restaurant->branch_name }}" class="restaurant-logo">
            @else
                <span class="restaurant-logo-placeholder">{{ substr($restaurant->branch_name, 0, 1) }}</span>
            @endif
        </div>

        {{-- QR Code --}}
        <div class="qr-code-container">
            @if($qrCode)
                <img src="{{ $qrCode }}" alt="QR Code" class="qr-code">
            @else
                <div class="qr-code-placeholder">QR kod mavjud emas</div>
            @endif
        </div>

        {{-- Multi-language texts --}}
        <div class="multilang-text">
            <p class="ru">Оцените качество обслуживания</p>
            <p>Xizmat sifatini baholang</p>
            <p>Xızmet sapasın bahalańız</p>
            <p>Rate the service quality</p>
        </div>
    </div>

    {{-- Print Button --}}
    <button class="print-btn no-print" onclick="window.print()">
        Печать
    </button>

    {{-- Back Link --}}
    <a href="{{ route('restaurants.index') }}" class="back-link no-print">
        &larr; Назад
    </a>
</body>
</html>
