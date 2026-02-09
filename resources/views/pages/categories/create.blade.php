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

                    <div class="form-group mb-3">
                        <label class="fw-bold mb-3">Переводы</label>
                        @foreach(getLanguages() as $language)
                        <div class="mb-3 p-3 border rounded" style="background-color: #f8f9fa;">
                            <h6 class="mb-3">{{ $language->name }} ({{ strtoupper($language->code) }})</h6>

                            <!-- Name input -->
                            <div class="mb-3">
                                <label for="translation_{{ $language->code }}_name" class="form-label">
                                    Название <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control @error('translations.' . $language->code . '.name') is-invalid @enderror"
                                    id="translation_{{ $language->code }}_name"
                                    name="translations[{{ $language->code }}][name]"
                                    value="{{ old('translations.' . $language->code . '.name') }}"
                                    placeholder="Название на {{ $language->name }}"
                                    required
                                    minlength="3"
                                    maxlength="255">
                                @error('translations.' . $language->code . '.name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description textarea -->
                            <div class="mb-0">
                                <label for="translation_{{ $language->code }}_description" class="form-label">
                                    Описание
                                </label>
                                <textarea
                                    class="form-control @error('translations.' . $language->code . '.description') is-invalid @enderror"
                                    id="translation_{{ $language->code }}_description"
                                    name="translations[{{ $language->code }}][description]"
                                    placeholder="Описание на {{ $language->name }}"
                                    rows="3"
                                    maxlength="1000">{{ old('translations.' . $language->code . '.description') }}</textarea>
                                @error('translations.' . $language->code . '.description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    <span class="char-count-{{ $language->code }}">0</span>/1000 символов
                                </small>
                            </div>
                        </div>
                        @endforeach
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
    @foreach(getLanguages() as $language)
    $('#translation_{{ $language->code }}_description').on('input', function() {
        var length = $(this).val().length;
        $('.char-count-{{ $language->code }}').text(length);
    });
    @endforeach
});
</script>
@endpush