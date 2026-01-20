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
                        <label class="fw-bold">Переводы</label>
                        @foreach(getLanguages() as $language)
                        <div class="mb-2">
                            <label for="translation_{{ $language->code }}" class="form-label">
                                {{ $language->name }} ({{ strtoupper($language->code) }})
                            </label>
                            <input type="text"
                                class="form-control @error('translations.' . $language->code) is-invalid @enderror"
                                id="translation_{{ $language->code }}"
                                name="translations[{{ $language->code }}]"
                                value="{{ old('translations.' . $language->code) }}"
                                placeholder="Название на {{ $language->name }}">
                            @error('translations.' . $language->code)
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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