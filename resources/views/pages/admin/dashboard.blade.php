@extends('layouts.main')

@section('title', 'Панель управления')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Панель управления</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb float-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active">Панель управления</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="row">
                <!-- Card 1: My Restaurants -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Мои рестораны</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['my_restaurants']) }}</h4>
                                </div>
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-building fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Reviews -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Всего отзывов</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['total_reviews']) }}</h4>
                                </div>
                                <div class="bg-info bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-comments fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Average Rating -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Средний рейтинг</div>
                                    <h4 class="mb-0 fw-bold">
                                        {{ $cards['average_rating'] }}
                                        <span class="text-warning"><i class="fa fa-star"></i></span>
                                    </h4>
                                </div>
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-star fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Guest Reviews -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Гостевые отзывы</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['guest_reviews']) }}</h4>
                                </div>
                                <div class="bg-secondary bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-user-o fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Today's Reviews -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Сегодняшние отзывы</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['today_reviews']) }}</h4>
                                </div>
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-calendar-check-o fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Five Star Reviews -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">5 звёзд</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['five_star']) }}</h4>
                                </div>
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-star fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 7: Top Restaurant -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="max-width: 70%;">
                                    <div class="text-muted small mb-1">Лучший ресторан</div>
                                    @if($cards['top_restaurant'])
                                    <h6 class="mb-1 fw-bold text-truncate" title="{{ $cards['top_restaurant']['name'] }}">
                                        {{ $cards['top_restaurant']['name'] }}
                                    </h6>
                                    <div class="text-success small">
                                        <i class="fa fa-star"></i>
                                        <strong>{{ $cards['top_restaurant']['avg_rating'] }}</strong>
                                        <span class="text-muted">({{ $cards['top_restaurant']['review_count'] }})</span>
                                    </div>
                                    @else
                                    <h4 class="mb-0 fw-bold">-</h4>
                                    @endif
                                </div>
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-trophy fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 8: Worst Restaurant -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div style="max-width: 70%;">
                                    <div class="text-muted small mb-1">Низкий рейтинг</div>
                                    @if($cards['worst_restaurant'])
                                    <h6 class="mb-1 fw-bold text-truncate" title="{{ $cards['worst_restaurant']['name'] }}">
                                        {{ $cards['worst_restaurant']['name'] }}
                                    </h6>
                                    <div class="text-danger small">
                                        <i class="fa fa-star"></i>
                                        <strong>{{ $cards['worst_restaurant']['avg_rating'] }}</strong>
                                        <span class="text-muted">({{ $cards['worst_restaurant']['review_count'] }})</span>
                                    </div>
                                    @else
                                    <h4 class="mb-0 fw-bold">-</h4>
                                    @endif
                                </div>
                                <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-arrow-down fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Push Notifications Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1"><i class="fa fa-bell"></i> Push уведомления</h5>
                                    <p class="text-muted mb-0 small">Получайте мгновенные уведомления о новых отзывах</p>
                                </div>
                                <div>
                                    <button id="enable-notifications-btn" class="btn btn-primary">
                                        <i class="fa fa-bell-o"></i> Включить уведомления
                                    </button>
                                    <button id="disable-notifications-btn" class="btn btn-danger" style="display: none;">
                                        <i class="fa fa-bell-slash-o"></i> Выключить
                                    </button>
                                    <button id="unblock-help-btn" class="btn btn-warning" style="display: none;">
                                        <i class="fa fa-question-circle"></i> Как разблокировать?
                                    </button>
                                    <span id="notification-status" class="badge bg-secondary ms-2"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="row">
                <!-- Chart 1: Reviews Trend (30 days) -->
                <div class="col-sm-12 col-xl-6 box-col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Динамика отзывов (30 дней)</h5>
                        </div>
                        <div class="card-body">
                            <div id="area-spaline"></div>
                        </div>
                    </div>
                </div>

                <!-- Chart 2: Monthly Reviews (12 months) -->
                <div class="col-sm-12 col-xl-6 box-col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Месячные отзывы (12 месяцев)</h5>
                        </div>
                        <div class="card-body">
                            <div id="monthly-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="row">
                <!-- Chart 3: Rating Distribution -->
                <div class="col-xl-6 col-md-12 box-col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Распределение рейтингов</h5>
                        </div>
                        <div class="card-body apex-chart">
                            <div id="donutchart"></div>
                        </div>
                    </div>
                </div>

                <!-- Chart 4: Guest vs Registered -->
                <div class="col-sm-12 col-xl-6 box-col-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Гостевые vs Зарегистрированные</h5>
                        </div>
                        <div class="card-body apex-chart">
                            <div id="piechart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- Firebase SDK -->
<script src="https://www.gstatic.com/firebasejs/10.7.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.7.0/firebase-messaging-compat.js"></script>
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/chartjs/chart.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var primary = localStorage.getItem('primary_color') || '#7366ff';
        var secondary = localStorage.getItem('secondary_color') || '#f73164';

        // Chart 1: Reviews Trend (Area Spaline)
        var reviewsTrendOptions = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'Количество отзывов',
                data: @json($charts['reviews_trend']['data'])
            }],
            xaxis: {
                categories: @json($charts['reviews_trend']['labels'])
            },
            colors: [primary]
        };

        var reviewsTrendChart = new ApexCharts(
            document.querySelector("#area-spaline"),
            reviewsTrendOptions
        );
        reviewsTrendChart.render();

        // Chart 2: Monthly Reviews (12 months - Area Chart)
        var monthlyOptions = {
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: 'Месячные отзывы',
                data: @json($charts['monthly_reviews']['data'])
            }],
            xaxis: {
                categories: @json($charts['monthly_reviews']['labels'])
            },
            colors: [secondary]
        };

        var monthlyChart = new ApexCharts(
            document.querySelector("#monthly-chart"),
            monthlyOptions
        );
        monthlyChart.render();

        // Chart 3: Rating Distribution (Donut)
        var ratingDistOptions = {
            chart: {
                width: 380,
                type: 'donut',
            },
            series: @json($charts['rating_distribution']['data']),
            labels: @json($charts['rating_distribution']['labels']),
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: ['#dc3545', '#fd7e14', '#ffc107', '#20c997', '#28a745']
        };

        var ratingDistChart = new ApexCharts(
            document.querySelector("#donutchart"),
            ratingDistOptions
        );
        ratingDistChart.render();

        // Chart 4: Guest vs Registered (Pie Chart)
        var guestVsRegOptions = {
            chart: {
                height: 400,
                type: 'pie',
            },
            labels: @json($charts['guest_vs_registered']['labels']),
            series: @json($charts['guest_vs_registered']['data']),
            legend: {
                position: 'bottom',
                fontSize: '14px'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: [secondary, primary]
        };

        var guestVsRegChart = new ApexCharts(
            document.querySelector("#piechart"),
            guestVsRegOptions
        );
        guestVsRegChart.render();
    });

    // ============================================
    // Firebase Cloud Messaging (FCM) Setup
    // ============================================

    // Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyBgMtPMATJwaA1IAgJef2nksTG_P-RJEnc",
        authDomain: "gastranomic-6377c.firebaseapp.com",
        projectId: "gastranomic-6377c",
        storageBucket: "gastranomic-6377c.firebasestorage.app",
        messagingSenderId: "911893928589",
        appId: "1:911893928589:web:85db2725899d618eb320c4"
    };

    // IMPORTANT: Replace with your VAPID key
    // Get this from: Firebase Console > Project Settings > Cloud Messaging > Web Push certificates
    const vapidKey = "BJV3ahrybzgo2vD5NvZ2S1B4G4dzPIODRv7EIu1BDp4GeTJVNHdvRltzKB9tDFM_XLEuUgkHOS-YzD1tP4OAgOg";

    // Initialize Firebase
    if (!firebase.apps.length) {
        firebase.initializeApp(firebaseConfig);
    }

    let messaging = null;
    let currentToken = null; // Store current FCM token

    // UI Elements (declare before using them)
    const enableBtn = document.getElementById('enable-notifications-btn');
    const disableBtn = document.getElementById('disable-notifications-btn');
    const unblockHelpBtn = document.getElementById('unblock-help-btn');
    const statusBadge = document.getElementById('notification-status');

    // Register service worker first, then initialize messaging
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then((registration) => {

                // Wait for Service Worker to be fully active
                return navigator.serviceWorker.ready;
            })
            .then((registration) => {
                try {
                    messaging = firebase.messaging();
                    checkNotificationStatus();

                    // Setup foreground message handler AFTER messaging is initialized
                    setupMessageHandler();
                } catch (error) {
                }
            })
            .catch((error) => {
                checkNotificationStatusOffline();
            });
    } else {
        checkNotificationStatusOffline();
    }

    async function checkNotificationStatus() {

        if (!('Notification' in window)) {
            // Detect iOS Safari
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

            if (isIOS && isSafari) {
                statusBadge.textContent = 'iOS не поддерживает';
                statusBadge.className = 'badge bg-secondary ms-2';
                enableBtn.disabled = true;
                enableBtn.title = 'Web push уведомления не поддерживаются в Safari на iOS';
            } else {
                statusBadge.textContent = 'Не поддерживается';
                statusBadge.className = 'badge bg-secondary ms-2';
                enableBtn.disabled = true;
            }
            return;
        }

        // Check HTTPS (except localhost)
        if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
            statusBadge.textContent = 'Требуется HTTPS';
            statusBadge.className = 'badge bg-warning ms-2';
            enableBtn.disabled = true;
            enableBtn.title = 'Push уведомления работают только на HTTPS';
            return;
        }


        if (Notification.permission === 'granted') {
            // Check if token exists in database
            try {
                if (!messaging) {
                    statusBadge.textContent = 'Выключены';
                    statusBadge.className = 'badge bg-warning ms-2';
                    enableBtn.style.display = 'inline-block';
                    disableBtn.style.display = 'none';
                    return;
                }

                // Wait for Service Worker to be active before getting token
                const registration = await navigator.serviceWorker.ready;

                // Check IndexedDB availability
                if (!window.indexedDB) {
                    statusBadge.textContent = 'Ошибка хранилища';
                    statusBadge.className = 'badge bg-warning ms-2';
                    enableBtn.style.display = 'inline-block';
                    disableBtn.style.display = 'none';
                    return;
                }

                let token;
                try {
                    token = await messaging.getToken({
                        vapidKey: vapidKey,
                        serviceWorkerRegistration: registration
                    });
                } catch (tokenError) {

                    // Service Worker yoki IndexedDB xatosi
                    if (tokenError.message && (
                        tokenError.message.includes('indexedDB') ||
                        tokenError.message.includes('backing store') ||
                        tokenError.message.includes('no active Service Worker') ||
                        tokenError.message.includes('Subscription failed')
                    )) {
                        statusBadge.textContent = 'Выключены';
                        statusBadge.className = 'badge bg-warning ms-2';
                        enableBtn.style.display = 'inline-block';
                        disableBtn.style.display = 'none';
                        return;
                    }
                    throw tokenError;
                }

                if (!token) {
                    statusBadge.textContent = 'Выключены';
                    statusBadge.className = 'badge bg-warning ms-2';
                    enableBtn.style.display = 'inline-block';
                    disableBtn.style.display = 'none';
                    return;
                }

                currentToken = token; // Store for later use

                // Verify token exists in database
                const response = await fetch('/admin/fcm-token/check', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ fcm_token: token })
                });

                const data = await response.json();

                if (data.success && data.has_token) {
                    statusBadge.textContent = 'Включены';
                    statusBadge.className = 'badge bg-success ms-2';
                    enableBtn.style.display = 'none';
                    disableBtn.style.display = 'inline-block';
                } else {
                    statusBadge.textContent = 'Выключены';
                    statusBadge.className = 'badge bg-warning ms-2';
                    enableBtn.style.display = 'inline-block';
                    disableBtn.style.display = 'none';
                }
            } catch (error) {
                statusBadge.textContent = 'Выключены';
                statusBadge.className = 'badge bg-warning ms-2';
                enableBtn.style.display = 'inline-block';
                disableBtn.style.display = 'none';
            }
        } else if (Notification.permission === 'denied') {
            statusBadge.textContent = 'Заблокированы';
            statusBadge.className = 'badge bg-danger ms-2';
            enableBtn.style.display = 'none';
            disableBtn.style.display = 'none';
            unblockHelpBtn.style.display = 'inline-block';
        } else {
            statusBadge.textContent = 'Выключены';
            statusBadge.className = 'badge bg-warning ms-2';
        }
    }

    function checkNotificationStatusOffline() {
        if (!('Notification' in window)) {
            statusBadge.textContent = 'Не поддерживается';
            statusBadge.className = 'badge bg-secondary ms-2';
            enableBtn.disabled = true;
            return;
        }
        statusBadge.textContent = 'Service Worker failed';
        statusBadge.className = 'badge bg-danger ms-2';
        enableBtn.disabled = true;
    }

    // Enable notifications
    enableBtn.addEventListener('click', async function(e) {
        e.preventDefault(); // Prevent page reload

        try {
            if (!messaging) {
                swal('Service Worker не готов', 'Пожалуйста, обновите страницу', 'warning');
                return;
            }

            enableBtn.disabled = true;
            enableBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Загрузка...';

            // Ensure Service Worker is ready before requesting permission
            await navigator.serviceWorker.ready;

            // Request permission
            const permission = await Notification.requestPermission();

            if (permission === 'granted') {
                // Check IndexedDB availability
                if (!window.indexedDB) {
                    swal('Ошибка', 'IndexedDB не поддерживается в этом браузере', 'error');
                    enableBtn.disabled = false;
                    enableBtn.innerHTML = '<i class="fa fa-bell-o"></i> Включить уведомления';
                    return;
                }

                // Get Service Worker registration
                const registration = await navigator.serviceWorker.ready;

                // Get FCM token
                let token;
                try {
                    token = await messaging.getToken({
                        vapidKey: vapidKey,
                        serviceWorkerRegistration: registration
                    });
                } catch (tokenError) {

                    // IndexedDB, storage yoki Service Worker xatosi
                    if (tokenError.message && (
                        tokenError.message.includes('indexedDB') ||
                        tokenError.message.includes('backing store') ||
                        tokenError.message.includes('no active Service Worker') ||
                        tokenError.message.includes('Subscription failed') ||
                        tokenError.message.includes('Internal error')
                    )) {
                        swal('Ошибка хранилища браузера', 'Пожалуйста, очистите кеш и cookies браузера и перезагрузите страницу', 'error');
                    } else {
                        swal('Ошибка', 'Не удалось получить токен: ' + tokenError.message, 'error');
                    }
                    enableBtn.disabled = false;
                    enableBtn.innerHTML = '<i class="fa fa-bell-o"></i> Включить уведомления';
                    return;
                }

                currentToken = token; // Store for later use

                // Save token to backend
                const response = await fetch('/admin/fcm-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        fcm_token: token
                    })
                });

                const data = await response.json();

                if (data.success) {
                    statusBadge.textContent = 'Включены';
                    statusBadge.className = 'badge bg-success ms-2';
                    enableBtn.style.display = 'none';
                    disableBtn.style.display = 'inline-block';

                    // Show success notification
                    new Notification('Уведомления включены!', {
                        body: 'Теперь вы будете получать уведомления о новых отзывах',
                        icon: '/favicon.ico'
                    });
                }
            } else {
                statusBadge.textContent = 'Заблокированы';
                statusBadge.className = 'badge bg-danger ms-2';
                swal('Доступ запрещен', 'Разрешение на уведомления было отклонено', 'error');
            }
        } catch (error) {
            swal('Ошибка', 'Ошибка при включении уведомлений: ' + error.message, 'error');
        } finally {
            enableBtn.disabled = false;
            enableBtn.innerHTML = '<i class="fa fa-bell-o"></i> Включить уведомления';
        }
    });

    // Disable notifications
    disableBtn.addEventListener('click', async function(e) {
        e.preventDefault(); // Prevent page reload

        try {
            if (!currentToken) {
                swal('Ошибка', 'Токен не найден', 'error');
                return;
            }

            disableBtn.disabled = true;

            // Remove token from backend
            const response = await fetch('/admin/fcm-token', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    fcm_token: currentToken
                })
            });

            const data = await response.json();

            if (data.success) {
                statusBadge.textContent = 'Выключены';
                statusBadge.className = 'badge bg-warning ms-2';
                disableBtn.style.display = 'none';
                enableBtn.style.display = 'inline-block';
                swal('Готово', 'Уведомления отключены', 'success');
            }
        } catch (error) {
            swal('Ошибка', 'Ошибка при отключении уведомлений', 'error');
        } finally {
            disableBtn.disabled = false;
        }
    });

    // Unblock help button - show instructions
    unblockHelpBtn.addEventListener('click', function(e) {
        e.preventDefault();

        // Detect mobile and browser
        const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
        const isChrome = /Chrome/.test(navigator.userAgent);
        const isFirefox = /Firefox/.test(navigator.userAgent);

        let instructions = '';

        if (isMobile && isChrome) {
            // Android Chrome
            instructions = '<b>Для Android Chrome:</b><br><br>' +
                         '1. Нажмите на <b>иконку замка 🔒</b> в адресной строке<br>' +
                         '2. Найдите <b>"Уведомления"</b> или <b>"Notifications"</b><br>' +
                         '3. Выберите <b>"Разрешить"</b><br>' +
                         '4. <b>Обновите страницу</b> (F5)';
        } else if (isMobile && isFirefox) {
            // Android Firefox
            instructions = '<b>Для Android Firefox:</b><br><br>' +
                         '1. Откройте меню (три точки)<br>' +
                         '2. Настройки → Разрешения → Уведомления<br>' +
                         '3. Найдите этот сайт и разрешите<br>' +
                         '4. Обновите страницу';
        } else if (isChrome) {
            // Desktop Chrome
            instructions = '<b>Для Chrome:</b><br><br>' +
                         '<b>Способ 1 (быстрый):</b><br>' +
                         '1. Нажмите на <b>иконку замка 🔒</b> слева от адреса<br>' +
                         '2. Найдите <b>"Уведомления"</b><br>' +
                         '3. Выберите <b>"Разрешить"</b><br>' +
                         '4. <b>Обновите страницу</b><br><br>' +
                         '<b>Способ 2 (через настройки):</b><br>' +
                         'Откройте: <code>chrome://settings/content/notifications</code>';
        } else if (isFirefox) {
            // Desktop Firefox
            instructions = '<b>Для Firefox:</b><br><br>' +
                         '1. Нажмите на иконку рядом с адресом<br>' +
                         '2. Найдите "Разрешения"<br>' +
                         '3. Включите уведомления<br>' +
                         '4. Обновите страницу';
        } else {
            // Other browsers
            instructions = '<b>Общая инструкция:</b><br><br>' +
                         '1. Откройте настройки браузера<br>' +
                         '2. Найдите раздел "Уведомления" или "Разрешения"<br>' +
                         '3. Найдите этот сайт в списке заблокированных<br>' +
                         '4. Измените на "Разрешить"<br>' +
                         '5. Обновите страницу';
        }

        swal({
            title: 'Как разблокировать уведомления',
            text: instructions,
            html: true,
            type: 'info'
        });
    });

    // Setup foreground message handler (called after messaging is initialized)
    function setupMessageHandler() {
        if (!messaging) {
            return;
        }

        messaging.onMessage((payload) => {

            const notificationTitle = payload.notification.title;
            const notificationOptions = {
                body: payload.notification.body,
                icon: '/favicon.ico',
                data: payload.data
            };

            // Show browser notification
            if (Notification.permission === 'granted') {
                const notification = new Notification(notificationTitle, notificationOptions);

                // Handle notification click
                notification.onclick = function(event) {
                    event.preventDefault();
                    window.focus();
                    if (payload.data.click_action) {
                        window.location.href = payload.data.click_action;
                    }
                };
            }
        });

    }
</script>
@endpush