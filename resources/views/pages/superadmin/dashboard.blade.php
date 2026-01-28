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
                        <div class="d-flex justify-content-end align-items-center gap-3">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-globe me-1"></i>
                                    @if($current_locale == 'uz')
                                    O'zbek
                                    @elseif($current_locale == 'ru')
                                    Русский
                                    @elseif($current_locale == 'en')
                                    English
                                    @elseif($current_locale == 'kk')
                                    Қазақ
                                    @endif
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                    <li><a class="dropdown-item {{ $current_locale == 'uz' ? 'active' : '' }}" href="{{ route('superadmin.dashboard.locale', 'uz') }}">O'zbek</a></li>
                                    <li><a class="dropdown-item {{ $current_locale == 'ru' ? 'active' : '' }}" href="{{ route('superadmin.dashboard.locale', 'ru') }}">Русский</a></li>
                                    <li><a class="dropdown-item {{ $current_locale == 'en' ? 'active' : '' }}" href="{{ route('superadmin.dashboard.locale', 'en') }}">English</a></li>
                                    <li><a class="dropdown-item {{ $current_locale == 'kk' ? 'active' : '' }}" href="{{ route('superadmin.dashboard.locale', 'kk') }}">Қазақ</a></li>
                                </ul>
                            </div>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active">Панель управления</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="row">
                <!-- Card 1: Total Restaurants -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Всего ресторанов</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['total_restaurants']) }}</h4>
                                </div>
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-building fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Guest Reviews -->
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

                <!-- Card 3: Total Reviews -->
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

                <!-- Card 4: Average Rating -->
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

                <!-- Card 5: Total Brands -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Всего брендов</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['total_brands']) }}</h4>
                                </div>
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-tag fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 6: Total Categories -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Всего категорий</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['total_categories']) }}</h4>
                                </div>
                                <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-folder fa-2x"></i>
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
                                    <div class="text-muted small mb-1">Топ ресторан</div>
                                    @if($cards['top_restaurant'])
                                    <h6 class="mb-1 fw-bold text-truncate" title="{{ $cards['top_restaurant']['name'] }}">
                                        {{ $cards['top_restaurant']['name'] }}
                                    </h6>
                                    <div class="text-warning small">
                                        <i class="fa fa-star"></i>
                                        <strong>{{ $cards['top_restaurant']['avg_rating'] }}</strong>
                                        <span class="text-muted">({{ $cards['top_restaurant']['review_count'] }})</span>
                                    </div>
                                    @else
                                    <h4 class="mb-0 fw-bold">-</h4>
                                    @endif
                                </div>
                                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-trophy fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 8: Total Admins -->
                <div class="col-xl-3 col-md-6 mb-4 box-col-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Всего админов</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cards['total_admins']) }}</h4>
                                </div>
                                <div class="bg-dark bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 1 -->
            <div class="row">
                <!-- Chart 1: Reviews Trend (Area Spaline) -->
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

                <!-- Chart 2: Rating Distribution (Donut) -->
                <div class="col-sm-12 col-xl-6 box-col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Распределение рейтингов</h5>
                        </div>
                        <div class="card-body apex-chart">
                            <div id="donutchart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row 2 -->
            <div class="row">
                <!-- Chart 3: Restaurants by Category (Bar Chart) -->
                <div class="col-xl-6 col-md-12 box-col-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Рестораны по категориям</h5>
                        </div>
                        <div class="card-body chart-block">
                            <canvas id="myBarGraph"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Chart 4: Top 5 Restaurants (Pie Chart) -->
                <div class="col-sm-12 col-xl-6 box-col-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5>Топ 5 ресторанов</h5>
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

        // Chart 2: Rating Distribution (Donut)
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

        // Chart 3: Restaurants by Category (Bar Chart.js)
        Chart.defaults.global = {
            animation: true,
            animationSteps: 60,
            animationEasing: "easeOutIn",
            showScale: true,
            scaleOverride: false,
            scaleSteps: null,
            scaleStepWidth: null,
            scaleStartValue: null,
            scaleLineColor: "#eeeeee",
            scaleLineWidth: 1,
            scaleShowLabels: true,
            scaleLabel: "<%=value%>",
            scaleIntegersOnly: true,
            scaleBeginAtZero: false,
            scaleFontSize: 12,
            scaleFontStyle: "normal",
            scaleFontColor: "#717171",
            responsive: true,
            maintainAspectRatio: true,
            showTooltips: true,
            multiTooltipTemplate: "<%= value %>",
            tooltipFillColor: "#333333",
            tooltipEvents: ["mousemove", "touchstart", "touchmove"],
            tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            tooltipFontSize: 14,
            tooltipFontStyle: "normal",
            tooltipFontColor: "#fff",
            tooltipTitleFontSize: 16,
            tooltipTitleFontStyle: "bold",
            tooltipTitleFontColor: "#ffffff",
            tooltipYPadding: 10,
            tooltipXPadding: 10,
            tooltipCaretSize: 8,
            tooltipCornerRadius: 6,
            tooltipXOffset: 5,
            onAnimationProgress: function() {},
            onAnimationComplete: function() {}
        };

        var barData = {
            labels: @json($charts['restaurants_by_category']['labels']),
            datasets: [{
                label: "Количество ресторанов",
                fillColor: "rgba(115, 102, 255, 0.4)",
                strokeColor: primary,
                highlightFill: "rgba(115, 102, 255, 0.6)",
                highlightStroke: primary,
                data: @json($charts['restaurants_by_category']['data'])
            }]
        };

        var barOptions = {
            scaleBeginAtZero: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,0.1)",
            scaleGridLineWidth: 1,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: false,
            barShowStroke: true,
            barStrokeWidth: 2,
            barValueSpacing: 5,
            barDatasetSpacing: 1
        };

        var ctx = document.getElementById("myBarGraph").getContext("2d");
        new Chart(ctx).Bar(barData, barOptions);

        // Chart 4: Top 5 Restaurants (Pie Chart)
        var top5Options = {
            chart: {
                height: 400,
                type: 'pie',
            },
            labels: @json($charts['top_5_restaurants']['labels']),
            series: @json($charts['top_5_restaurants']['data']),
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
            colors: [primary, secondary, '#51bb25', '#a927f9', '#f8d62b']
        };

        var top5Chart = new ApexCharts(
            document.querySelector("#piechart"),
            top5Options
        );
        top5Chart.render();
    });
</script>
@endpush