@extends('layouts.main')

@section('title', 'Создать категорию вопроса')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Создать новую категорию вопроса</h3>
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
                                <li class="breadcrumb-item active">Создать</li>
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
                        <form action="{{ route('questions.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="key">Ключ <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ old('key') }}" required placeholder="например: what_did_you_like">
                                            @error('key')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">Уникальный идентификатор на английском</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="sort_order">Порядок сортировки <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}" required min="0">
                                            @error('sort_order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_required" name="is_required" value="1" {{ old('is_required') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_required">
                                                Обязательный вопрос
                                            </label>
                                            <small class="d-block text-muted">Если отмечено, пользователь должен ответить на этот вопрос</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Активна
                                            </label>
                                            <small class="d-block text-muted">Показывать в API</small>
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
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $code }}-content" role="tabpanel">
                                            <div class="form-group mb-3">
                                                <label for="{{ $code }}_title">Названи вопроса <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error("translations.$code.title") is-invalid @enderror" id="{{ $code }}_title" name="translations[{{ $code }}][lang_code]" value="{{ $code }}" hidden>
                                                <input type="text" class="form-control @error("translations.$code.title") is-invalid @enderror" id="{{ $code }}_title" name="translations[{{ $code }}][title]" value="{{ old("translations.$code.title") }}" required placeholder="Введите название вопроса">
                                                @error("translations.$code.title")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="{{ $code }}_description">Описание</label>
                                                <textarea class="form-control @error("translations.$code.description") is-invalid @enderror" id="{{ $code }}_description" name="translations[{{ $code }}][description]" rows="3" placeholder="Введите описание (опционально)">{{ old("translations.$code.description") }}</textarea>
                                                @error("translations.$code.description")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted"><span class="char-count-{{ $code }}">0</span>/1000 символов</small>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">Отмена</a>
                                <button type="submit" class="btn btn-primary">Создать</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">
                            <h5>Справка</h5>
                        </div>
                        <div class="card-body text-dark">
                            <p><strong>Ключ:</strong> Уникальный идентификатор на английском языке, используется в API и коде.</p>
                            <p><strong>Порядок:</strong> Число определяет, в каком порядке показываются вопросы.</p>
                            <p><strong>Обязательный:</strong> Если включено, пользователь должен ответить на вопрос при оставлении отзыва.</p>
                            <p><strong>Переводы:</strong> Введите названи вопроса на всех поддерживаемых языках.</p>
                            <hr>
                            <p class="small"><strong>После создания</strong> вы сможете добавлять варианты ответов для этой категории.</p>
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
    // Fix hidden lang_code inputs to have proper values
    @foreach(['uz', 'ru', 'kk', 'en'] as $code)
    $('input[name="translations[{{ $code }}][lang_code]"]').val('{{ $code }}');
    @endforeach

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
