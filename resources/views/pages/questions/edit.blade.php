@extends('layouts.main')

@section('title', 'Редактировать вопрос')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Редактировать категорию вопроса</h3>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end align-items-center gap-3">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-globe me-1"></i>
                                    @php
                                    $current_locale = session('locale', 'ru');
                                    $locale_labels = [
                                        'uz' => 'O\'zbek',
                                        'ru' => 'Русский',
                                        'en' => 'English',
                                        'kk' => 'Қарақалпақ'
                                    ];
                                    @endphp
                                    {{ $locale_labels[$current_locale] ?? 'Русский' }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                    <li><a class="dropdown-item {{ session('locale', 'ru') == 'uz' ? 'active' : '' }}" href="{{ route('questions.locale', 'uz') }}">O'zbek</a></li>
                                    <li><a class="dropdown-item {{ session('locale', 'ru') == 'ru' ? 'active' : '' }}" href="{{ route('questions.locale', 'ru') }}">Русский</a></li>
                                    <li><a class="dropdown-item {{ session('locale', 'ru') == 'en' ? 'active' : '' }}" href="{{ route('questions.locale', 'en') }}">English</a></li>
                                    <li><a class="dropdown-item {{ session('locale', 'ru') == 'kk' ? 'active' : '' }}" href="{{ route('questions.locale', 'kk') }}">Қарақалпақ</a></li>
                                </ul>
                            </div>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('questions.index') }}">Вопросы</a></li>
                                <li class="breadcrumb-item active">Редактировать</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Основная информация</h5>
                        </div>
                        <form action="{{ route('questions.update', $question) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="key">Ключ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ old('key', $question->key) }}" required>
                                            @error('key')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="sort_order">Порядок сортировки <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $question->sort_order) }}" required min="0">
                                            @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_required" name="is_required" value="1" {{ old('is_required', $question->is_required) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_required">
                                                Обязательный вопрос
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $question->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Активна
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Translation Tabs -->
                                <div class="mt-4">
                                    <h6>Переводы</h6>
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        @foreach(['uz' => 'Ўзбек', 'ru' => 'Русский', 'kk' => 'Қарақалпақ', 'en' => 'English'] as $code => $label)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $code }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $code }}-content" type="button" role="tab">{{ $label }}</button>
                                        </li>
                                        @endforeach
                                    </ul>

                                    <div class="tab-content">
                                        @foreach(['uz' => 'Ўзбек', 'ru' => 'Русский', 'kk' => 'Қарақалпақ', 'en' => 'English'] as $code => $label)
                                        @php
                                        $translation = $question->translations->firstWhere('lang_code', $code);
                                        @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $code }}-content" role="tabpanel">
                                            <input type="hidden" name="translations[{{ $code }}][lang_code]" value="{{ $code }}">
                                            <div class="form-group mb-3">
                                                <label for="{{ $code }}_title">Названи вопроса <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error("translations.$code.title") is-invalid @enderror" id="{{ $code }}_title" name="translations[{{ $code }}][title]" value="{{ old("translations.$code.title", $translation?->title) }}" required>
                                                @error("translations.$code.title")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="{{ $code }}_description">Описание</label>
                                                <textarea class="form-control @error("translations.$code.description") is-invalid @enderror" id="{{ $code }}_description" name="translations[{{ $code }}][description]" rows="3" placeholder="Введите описание (опционально)">{{ old("translations.$code.description", $translation?->description) }}</textarea>
                                                @error("translations.$code.description")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted"><span class="char-count-{{ $code }}">{{ strlen($translation?->description ?? '') }}</span>/1000 символов</small>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">Отмена</a>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Варианты ответов</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @forelse($question->options as $option)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted"><strong>ID: {{ $option->id }}</strong></small>
                                        <div class="small">
                                            @foreach($option->translations->take(1) as $trans)
                                            {{ $trans->text }}
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-info">{{ $option->translations->count() }} пер.</span>
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted small">Варианты ответов еще не добавлены</p>
                                @endforelse
                            </div>
                            <div class="mt-3">
                                <a href="#" class="btn btn-sm btn-outline-success btn-block">
                                    <i class="fa fa-plus"></i> Добавить вариант
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card bg-light mt-3">
                        <div class="card-header">
                            <h5>Информация</h5>
                        </div>
                        <div class="card-body small">
                            <p><strong>ID:</strong> {{ $question->id }}</p>
                            <p><strong>Всего вариантов:</strong> {{ $question->options()->count() }}</p>
                            <p><strong>Языков:</strong> {{ $question->translations->count() }}</p>
                            <p><strong>Создано:</strong> {{ $question->created_at->format('d.m.Y H:i') }}</p>
                            <p><strong>Обновлено:</strong> {{ $question->updated_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Character count for description fields
    let languages = ['uz', 'ru', 'kk', 'en'];
    languages.forEach(function(lang) {
        $('#' + lang + '_description').on('input', function() {
            var length = $(this).val().length;
            $('.char-count-' + lang).text(length);
        });
    });
});
</script>
@endpush
@endsection
