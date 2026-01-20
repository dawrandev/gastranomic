<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Редактировать категорию</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_category_id" name="category_id">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="edit_icon">Иконка</label>
                        <div class="mb-2">
                            <img id="current_icon_preview" src="" alt="Current icon" class="img-thumbnail" style="max-width: 100px; max-height: 100px; display: none;">
                        </div>
                        <input type="file" class="form-control" id="edit_icon" name="icon" accept="image/*">
                        <small class="form-text text-muted">Оставьте пустым, если не хотите менять. Форматы: jpg, jpeg, png, svg. Макс. размер: 2MB</small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold">Переводы</label>
                        @foreach(getLanguages() as $language)
                        <div class="mb-2">
                            <label for="edit_translation_{{ $language->code }}" class="form-label">
                                {{ $language->name }} ({{ strtoupper($language->code) }})
                            </label>
                            <input type="text"
                                class="form-control"
                                id="edit_translation_{{ $language->code }}"
                                name="translations[{{ $language->code }}]"
                                placeholder="Название на {{ $language->name }}">
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>