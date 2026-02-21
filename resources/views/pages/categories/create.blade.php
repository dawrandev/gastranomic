<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Новая категория</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="icon">Иконка</label>
                        <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" accept="image/*">
                        @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Форматы: jpg, jpeg, png, svg. Макс. размер: 2MB</small>
                    </div>

                    <!-- Translation sections for each language -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="uz-tab" data-bs-toggle="tab" data-bs-target="#uz-content" type="button" role="tab">Ўзбек</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="ru-tab" data-bs-toggle="tab" data-bs-target="#ru-content" type="button" role="tab">Русский</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="kk-tab" data-bs-toggle="tab" data-bs-target="#kk-content" type="button" role="tab">Қарақалпақ</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-content" type="button" role="tab">English</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Uzbek -->
                        <div class="tab-pane fade show active" id="uz-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="uz_name">Название <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('translations.uz.name') is-invalid @enderror" id="uz_name" name="translations[uz][name]" value="{{ old('translations.uz.name') }}" required>
                                @error('translations.uz.name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="uz_description">Описание</label>
                                <textarea class="form-control @error('translations.uz.description') is-invalid @enderror" id="uz_description" name="translations[uz][description]" rows="3" placeholder="Описание на Ўзбек">{{ old('translations.uz.description') }}</textarea>
                                @error('translations.uz.description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted"><span class="char-count-uz">0</span>/1000 символов</small>
                            </div>
                        </div>

                        <!-- Russian -->
                        <div class="tab-pane fade" id="ru-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="ru_name">Название</label>
                                <input type="text" class="form-control @error('translations.ru.name') is-invalid @enderror" id="ru_name" name="translations[ru][name]" value="{{ old('translations.ru.name') }}">
                                @error('translations.ru.name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="ru_description">Описание</label>
                                <textarea class="form-control @error('translations.ru.description') is-invalid @enderror" id="ru_description" name="translations[ru][description]" rows="3" placeholder="Описание на Русский">{{ old('translations.ru.description') }}</textarea>
                                @error('translations.ru.description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted"><span class="char-count-ru">0</span>/1000 символов</small>
                            </div>
                        </div>

                        <!-- Karakalpak -->
                        <div class="tab-pane fade" id="kk-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="kk_name">Название</label>
                                <input type="text" class="form-control @error('translations.kk.name') is-invalid @enderror" id="kk_name" name="translations[kk][name]" value="{{ old('translations.kk.name') }}">
                                @error('translations.kk.name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="kk_description">Описание</label>
                                <textarea class="form-control @error('translations.kk.description') is-invalid @enderror" id="kk_description" name="translations[kk][description]" rows="3" placeholder="Описание на Қарақалпақ">{{ old('translations.kk.description') }}</textarea>
                                @error('translations.kk.description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted"><span class="char-count-kk">0</span>/1000 символов</small>
                            </div>
                        </div>

                        <!-- English -->
                        <div class="tab-pane fade" id="en-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="en_name">Название</label>
                                <input type="text" class="form-control @error('translations.en.name') is-invalid @enderror" id="en_name" name="translations[en][name]" value="{{ old('translations.en.name') }}">
                                @error('translations.en.name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="en_description">Описание</label>
                                <textarea class="form-control @error('translations.en.description') is-invalid @enderror" id="en_description" name="translations[en][description]" rows="3" placeholder="Описание на English">{{ old('translations.en.description') }}</textarea>
                                @error('translations.en.description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted"><span class="char-count-en">0</span>/1000 символов</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
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