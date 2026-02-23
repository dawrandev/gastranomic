@extends('layouts.main')

@section('title', 'Отзывы и рейтинги')

@push('styles')
<style>
    .review-card {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }
    .review-card:hover {
        box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.1);
        border-left-color: var(--bs-primary);
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Отзывы и рейтинги</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb float-end">
                            @role('superadmin')
                            <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @else
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                            @endrole
                            <li class="breadcrumb-item active">Отзывы</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Всего отзывов</div>
                                    <h4 class="mb-0 fw-bold">{{ number_format($statistics['total_reviews']) }}</h4>
                                </div>
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-comments fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">Средний рейтинг</div>
                                    <h4 class="mb-0 fw-bold">
                                        {{ $statistics['average_rating'] }}
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

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">5 звезд</div>
                                    <h4 class="mb-0 fw-bold text-success">{{ number_format($statistics['five_star']) }}</h4>
                                </div>
                                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-thumbs-up fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-muted small mb-1">1-2 звезды</div>
                                    <h4 class="mb-0 fw-bold text-danger">{{ number_format($statistics['one_star'] + $statistics['two_star']) }}</h4>
                                </div>
                                <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                    <i class="fa fa-thumbs-down fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rating Distribution -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">Распределение рейтингов</h5>
                        </div>
                        <div class="card-body">
                            @php
                            $maxCount = max($statistics['five_star'], $statistics['four_star'], $statistics['three_star'], $statistics['two_star'], $statistics['one_star']);
                            @endphp
                            @foreach([5, 4, 3, 2, 1] as $rating)
                            @php
                            $count = $statistics[match($rating) {
                            5 => 'five_star',
                            4 => 'four_star',
                            3 => 'three_star',
                            2 => 'two_star',
                            1 => 'one_star',
                            }];
                            $percentage = $statistics['total_reviews'] > 0 ? ($count / $statistics['total_reviews']) * 100 : 0;
                            @endphp
                            <div class="row align-items-center mb-2">
                                <div class="col-auto">
                                    <span class="text-muted">{{ $rating }} <i class="fa fa-star text-warning"></i></span>
                                </div>
                                <div class="col">
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($percentage, 1) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-secondary">{{ $count }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Answers Statistics -->
            @if(!empty($questionStats))
            <div class="row mb-4">
                <!-- Card 1: Would Return Again -->
                <div class="col-xl-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fa fa-redo text-primary"></i> Вернутся снова?</h5>
                        </div>
                        <div class="card-body">
                            @php
                            $totalWouldReturn = ($questionStats['yes'] ?? 0) + ($questionStats['maybe'] ?? 0) + ($questionStats['no'] ?? 0);
                            @endphp
                            <div class="row align-items-center mb-3">
                                <div class="col-auto" style="min-width: 100px;">
                                    <span class="text-success"><i class="fa fa-check-circle"></i> Да</span>
                                </div>
                                <div class="col">
                                    <div class="progress" style="height: 20px;">
                                        @php
                                        $yesCount = $questionStats['yes'] ?? 0;
                                        $yesPercentage = $totalWouldReturn > 0 ? ($yesCount / $totalWouldReturn) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $yesPercentage }}%">
                                            {{ number_format($yesPercentage, 1) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-success">{{ $yesCount }}</span>
                                </div>
                            </div>

                            <div class="row align-items-center mb-3">
                                <div class="col-auto" style="min-width: 100px;">
                                    <span class="text-warning"><i class="fa fa-question-circle"></i> Может быть</span>
                                </div>
                                <div class="col">
                                    <div class="progress" style="height: 20px;">
                                        @php
                                        $maybeCount = $questionStats['maybe'] ?? 0;
                                        $maybePercentage = $totalWouldReturn > 0 ? ($maybeCount / $totalWouldReturn) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $maybePercentage }}%">
                                            {{ number_format($maybePercentage, 1) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-warning">{{ $maybeCount }}</span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-auto" style="min-width: 100px;">
                                    <span class="text-danger"><i class="fa fa-times-circle"></i> Нет</span>
                                </div>
                                <div class="col">
                                    <div class="progress" style="height: 20px;">
                                        @php
                                        $noCount = $questionStats['no'] ?? 0;
                                        $noPercentage = $totalWouldReturn > 0 ? ($noCount / $totalWouldReturn) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $noPercentage }}%">
                                            {{ number_format($noPercentage, 1) }}%
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-danger">{{ $noCount }}</span>
                                </div>
                            </div>

                            <div class="mt-3 pt-3 border-top">
                                <small class="text-muted">Всего ответов: <strong>{{ $totalWouldReturn }}</strong></small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Visit Category -->
                <div class="col-xl-6 mb-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fa fa-utensils text-primary"></i> Категория посещения</h5>
                        </div>
                        <div class="card-body">
                            @php
                            $visitCategories = [
                                'breakfast' => ['label' => 'Завтрак', 'icon' => 'fa-coffee', 'color' => 'info'],
                                'lunch' => ['label' => 'Обед', 'icon' => 'fa-utensils', 'color' => 'primary'],
                                'dinner' => ['label' => 'Ужин', 'icon' => 'fa-moon', 'color' => 'dark'],
                                'coffee' => ['label' => 'Кофе', 'icon' => 'fa-mug-hot', 'color' => 'warning'],
                                'dessert' => ['label' => 'Десерт', 'icon' => 'fa-ice-cream', 'color' => 'danger'],
                                'other' => ['label' => 'Другое', 'icon' => 'fa-ellipsis-h', 'color' => 'secondary'],
                            ];
                            $totalVisitCategory = array_sum(array_map(fn($key) => $questionStats[$key] ?? 0, array_keys($visitCategories)));
                            @endphp

                            @foreach($visitCategories as $key => $category)
                            @php
                            $count = $questionStats[$key] ?? 0;
                            $percentage = $totalVisitCategory > 0 ? ($count / $totalVisitCategory) * 100 : 0;
                            @endphp
                            <div class="row align-items-center mb-2">
                                <div class="col-auto" style="min-width: 100px;">
                                    <span class="text-{{ $category['color'] }}"><i class="fa {{ $category['icon'] }}"></i> {{ $category['label'] }}</span>
                                </div>
                                <div class="col">
                                    <div class="progress" style="height: 18px;">
                                        <div class="progress-bar bg-{{ $category['color'] }}" role="progressbar" style="width: {{ $percentage }}%">
                                            @if($percentage > 15)
                                            {{ number_format($percentage, 0) }}%
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-{{ $category['color'] }}">{{ $count }}</span>
                                </div>
                            </div>
                            @endforeach

                            <div class="mt-3 pt-3 border-top">
                                <small class="text-muted">Всего ответов: <strong>{{ $totalVisitCategory }}</strong></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Overall Satisfaction & Additional Comments Summary -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fa fa-comments text-primary"></i> Отзывы и комментарии</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center border-end">
                                    <div class="mb-2">
                                        <i class="fa fa-comment-dots fa-2x text-primary"></i>
                                    </div>
                                    <h4 class="mb-1">{{ $statistics['total_reviews'] }}</h4>
                                    <small class="text-muted">Всего отзывов</small>
                                </div>
                                <div class="col-md-3 text-center border-end">
                                    <div class="mb-2">
                                        <i class="fa fa-comment-alt fa-2x text-success"></i>
                                    </div>
                                    @php
                                    $withComments = \App\Models\Review::whereNotNull('comment')->where('comment', '!=', '')->count();
                                    @endphp
                                    <h4 class="mb-1">{{ $withComments }}</h4>
                                    <small class="text-muted">С текстовыми комментариями</small>
                                </div>
                                <div class="col-md-3 text-center border-end">
                                    <div class="mb-2">
                                        <i class="fa fa-check-square fa-2x text-info"></i>
                                    </div>
                                    @php
                                    $withAnswers = \App\Models\Review::has('selectedOptions')->count();
                                    @endphp
                                    <h4 class="mb-1">{{ $withAnswers }}</h4>
                                    <small class="text-muted">С выбранными вариантами</small>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="mb-2">
                                        <i class="fa fa-chart-line fa-2x text-warning"></i>
                                    </div>
                                    @php
                                    $avgAnswers = \App\Models\Review::withCount('selectedOptions')->get()->avg('selected_options_count');
                                    @endphp
                                    <h4 class="mb-1">{{ number_format($avgAnswers, 1) }}</h4>
                                    <small class="text-muted">Среднее вариантов на отзыв</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Reviews List -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <h5 class="mb-0">Все отзывы ({{ $reviews->total() }})</h5>
                                <div class="d-flex gap-2 flex-wrap">
                                    @role('superadmin')
                                    <select id="restaurant-filter" class="form-control" style="min-width: 250px;">
                                        <option value="">Все рестораны</option>
                                        @foreach(\App\Models\Restaurant::orderBy('branch_name')->get() as $restaurant)
                                        <option value="{{ $restaurant->id }}" {{ request('restaurant_id') == $restaurant->id ? 'selected' : '' }}>
                                            {{ $restaurant->branch_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @endrole
                                    <select id="rating-filter" class="form-select form-select-sm" style="min-width: 150px;">
                                        <option value="">Все рейтинги</option>
                                        <option value="5" {{ request('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                                        <option value="4" {{ request('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                                        <option value="3" {{ request('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                                        <option value="2" {{ request('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2)</option>
                                        <option value="1" {{ request('rating') == 1 ? 'selected' : '' }}>⭐ (1)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0" style="min-height: 200px;">
                            <div id="reviews-container">
                                @include('pages.reviews.partials.review-list', ['reviews' => $reviews])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 (Cuba Admin style)
    @role('superadmin')
    $('#restaurant-filter').select2({
        placeholder: 'Выберите ресторан',
        allowClear: true,
        width: '100%'
    });
    @endrole

    // AJAX Filter Function
    function loadReviews(page = 1) {
        const restaurantId = $('#restaurant-filter').length ? $('#restaurant-filter').val() : '';
        const rating = $('#rating-filter').val();

        $.ajax({
            url: '{{ route("reviews.index") }}',
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            data: {
                restaurant_id: restaurantId,
                rating: rating,
                page: page,
                ajax: '1'
            },
            success: function(response) {
                $('#reviews-container').html(response.html);

                // Update URL without reload
                const url = new URL(window.location);
                if (restaurantId) {
                    url.searchParams.set('restaurant_id', restaurantId);
                } else {
                    url.searchParams.delete('restaurant_id');
                }
                if (rating) {
                    url.searchParams.set('rating', rating);
                } else {
                    url.searchParams.delete('rating');
                }
                url.searchParams.set('page', page);
                window.history.pushState({}, '', url);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                console.log('Response:', xhr.responseText);
                alert('Ошибка загрузки отзывов');
            }
        });
    }

    // Filter change events
    @role('superadmin')
    $('#restaurant-filter').on('change', function() {
        loadReviews(1);
    });
    @endrole

    $('#rating-filter').on('change', function() {
        loadReviews(1);
    });

    // Pagination click handler (delegated)
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const page = $(this).attr('href').split('page=')[1];
        if (page) {
            loadReviews(page);
        }
    });
});
</script>
@endpush