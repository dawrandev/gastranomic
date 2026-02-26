@extends('layouts.main')

@section('title', 'Категории вопросов')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Категории вопросов для отзывов</h3>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end align-items-center gap-3">
                            <div>
                                <select id="languageSelect" class="form-select form-select-sm" style="width: auto;">
                                    <option value="uz" {{ session('locale', 'ru') == 'uz' ? 'selected' : '' }}>O'zbek</option>
                                    <option value="ru" {{ session('locale', 'ru') == 'ru' ? 'selected' : '' }}>Русский</option>
                                    <option value="en" {{ session('locale', 'ru') == 'en' ? 'selected' : '' }}>English</option>
                                    <option value="kk" {{ session('locale', 'ru') == 'kk' ? 'selected' : '' }}>Қарақалпақ</option>
                                </select>
                            </div>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active">Вопросы</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Все категории вопросов</h5>
                                <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-plus"></i> Новая категория
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('questions.index') }}">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control" placeholder="Поиск..." value="{{ request('search') }}">
                                            <button type="submit" class="btn btn-outline-info"><i class="fa fa-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">№</th>
                                            <th style="width: 120px;">Ключ</th>
                                            <th>Название вопроса</th>
                                            <th style="width: 250px;">Дополнительные вопросы</th>
                                            <th style="width: 80px;">Обязателен</th>
                                            <th style="width: 80px;">Статус</th>
                                            <th style="width: 100px;">Варианты</th>
                                            <th style="width: 120px">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody id="questionsTableBody">
                                        @php
                                        $counter = ($questions->currentPage() - 1) * $questions->perPage() + 1;
                                        @endphp
                                        @forelse ($questions as $question)
                                        <tr class="question-row" data-question-id="{{ $question->id }}">
                                            <td>{{ $counter++ }}</td>
                                            <td>
                                                <code>{{ $question->key }}</code>
                                            </td>
                                            <td class="question-title">
                                                {{ $question->translations->firstWhere('lang_code', session('locale', 'ru'))?->title ?? $question->key }}
                                            </td>
                                            <td class="sub-questions-cell">
                                                @if($question->children()->count() > 0)
                                                    <div class="sub-questions-list">
                                                        @php
                                                        $subQuestions = $question->children()->orderBy('sort_order')->get();
                                                        @endphp
                                                        @foreach($subQuestions as $idx => $child)
                                                        <div class="sub-question-item mb-2">
                                                            <small>
                                                                <strong>{{ chr(65 + $idx) }}.</strong>
                                                                {{ $child->translations->firstWhere('lang_code', session('locale', 'ru'))?->title ?? $child->key }}
                                                            </small>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($question->is_required)
                                                <span class="badge bg-success">Да</span>
                                                @else
                                                <span class="badge bg-secondary">Нет</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($question->is_active)
                                                <span class="badge bg-success">Активно</span>
                                                @else
                                                <span class="badge bg-danger">Неактивно</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($question->options()->count() > 0 || $question->children()->count() > 0)
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#optionsModal{{ $question->id }}">
                                                        <i class="fa fa-eye"></i> {{ $question->options()->count() }}
                                                    </button>
                                                @else
                                                    <span class="badge bg-secondary">0</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('questions.edit', $question) }}" class="btn btn-sm btn-outline-warning" title="Редактировать">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('questions.destroy', $question) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Удалить" onclick="return confirm('Вы уверены?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Нет категорий вопросов</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Options Modals -->
                            @foreach ($questions as $question)
                                @if($question->options()->count() > 0 || $question->children()->count() > 0)
                                <div class="modal fade" id="optionsModal{{ $question->id }}" tabindex="-1" aria-labelledby="optionsModalLabel{{ $question->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="optionsModalLabel{{ $question->id }}">
                                                    <strong>{{ $question->key }}</strong>
                                                    <br>
                                                    <small class="text-muted modal-question-title">
                                                        {{ $question->translations->firstWhere('lang_code', session('locale', 'ru'))?->title ?? $question->key }}
                                                    </small>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" data-question-id="{{ $question->id }}">
                                                <!-- Options Table -->
                                                @if($question->options()->count() > 0)
                                                <div>
                                                    <h6 class="mb-3">Варианты ответов</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm options-table">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th style="width: 40px;">ID</th>
                                                                    <th class="lang-cell-uz">O'zbek</th>
                                                                    <th class="lang-cell-ru">Русский</th>
                                                                    <th class="lang-cell-kk">Қарақалпақ</th>
                                                                    <th class="lang-cell-en">English</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($question->options()->orderBy('sort_order')->get() as $option)
                                                                <tr>
                                                                    <td><strong>{{ $option->id }}</strong></td>
                                                                    <td class="lang-cell-uz">{{ $option->translations->firstWhere('lang_code', 'uz')?->text ?? '—' }}</td>
                                                                    <td class="lang-cell-ru">{{ $option->translations->firstWhere('lang_code', 'ru')?->text ?? '—' }}</td>
                                                                    <td class="lang-cell-kk">{{ $option->translations->firstWhere('lang_code', 'kk')?->text ?? '—' }}</td>
                                                                    <td class="lang-cell-en">{{ $option->translations->firstWhere('lang_code', 'en')?->text ?? '—' }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @endif

                                                <!-- Sub-questions -->
                                                @if($question->children()->count() > 0)
                                                <div class="mt-4">
                                                    <h6 class="mb-3">Дополнительные вопросы (условные)</h6>
                                                    @php $subIdx = 0; @endphp
                                                    @foreach($question->children()->orderBy('sort_order')->get() as $child)
                                                    <div class="card mb-3 sub-question-card">
                                                        <div class="card-header py-2 bg-light">
                                                            <div class="d-flex justify-content-between align-items-start">
                                                                <div>
                                                                    <span class="badge bg-primary me-2">{{ chr(65 + $subIdx++) }}</span>
                                                                    <strong class="sub-question-title">
                                                                        {{ $child->translations->firstWhere('lang_code', session('locale', 'ru'))?->title ?? $child->key }}
                                                                    </strong>
                                                                    @if($child->allow_multiple)
                                                                    <small class="badge bg-warning ms-2">Множ. выбор</small>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-2">
                                                            @if($child->options()->count() > 0)
                                                            <div class="table-responsive">
                                                                <table class="table table-sm table-bordered mb-0 sub-options-table">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th style="width: 40px;">ID</th>
                                                                            <th class="lang-cell-uz">O'zbek</th>
                                                                            <th class="lang-cell-ru">Русский</th>
                                                                            <th class="lang-cell-kk">Қарақалпақ</th>
                                                                            <th class="lang-cell-en">English</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($child->options()->orderBy('sort_order')->get() as $childOpt)
                                                                        <tr>
                                                                            <td><strong>{{ $childOpt->id }}</strong></td>
                                                                            <td class="lang-cell-uz">{{ $childOpt->translations->firstWhere('lang_code', 'uz')?->text ?? '—' }}</td>
                                                                            <td class="lang-cell-ru">{{ $childOpt->translations->firstWhere('lang_code', 'ru')?->text ?? '—' }}</td>
                                                                            <td class="lang-cell-kk">{{ $childOpt->translations->firstWhere('lang_code', 'kk')?->text ?? '—' }}</td>
                                                                            <td class="lang-cell-en">{{ $childOpt->translations->firstWhere('lang_code', 'en')?->text ?? '—' }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @else
                                                            <p class="text-muted small mb-0">(Открытый вопрос - свободный ответ)</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Закрыть</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach

                            {{ $questions->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('styles')
<style>
.sub-questions-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.sub-question-item {
    padding: 0.35rem 0;
    line-height: 1.4;
    font-size: 0.875rem;
    border-bottom: 1px solid #f0f0f0;
}

.sub-question-item:last-child {
    border-bottom: none;
    margin-bottom: 0 !important;
}

.sub-question-item strong {
    font-weight: 600;
    color: #0d6efd;
    margin-right: 0.3rem;
}
</style>
@endpush

@push('scripts')
<script>
document.getElementById('languageSelect').addEventListener('change', function() {
    window.location.href = `{{ route('questions.locale', '') }}/${this.value}`;
});
</script>
@endpush

@endsection
