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
                        <label class="fw-bold mb-3">Переводы</label>
                        @foreach(getLanguages() as $language)
                        <div class="mb-3 p-3 border rounded" style="background-color: #f8f9fa;">
                            <h6 class="mb-3">{{ $language->name }} ({{ strtoupper($language->code) }})</h6>

                            <!-- Name input -->
                            <div class="mb-3">
                                <label for="edit_translation_{{ $language->code }}_name" class="form-label">
                                    Название <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control"
                                    id="edit_translation_{{ $language->code }}_name"
                                    name="translations[{{ $language->code }}][name]"
                                    placeholder="Название на {{ $language->name }}"
                                    minlength="3"
                                    maxlength="255">
                            </div>

                            <!-- Description textarea -->
                            <div class="mb-0">
                                <label for="edit_translation_{{ $language->code }}_description" class="form-label">
                                    Описание
                                </label>
                                <textarea
                                    class="form-control"
                                    id="edit_translation_{{ $language->code }}_description"
                                    name="translations[{{ $language->code }}][description]"
                                    placeholder="Описание на {{ $language->name }}"
                                    rows="3"
                                    maxlength="1000"></textarea>
                                <small class="text-muted">
                                    <span class="edit-char-count-{{ $language->code }}">0</span>/1000 символов
                                </small>
                            </div>
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

@push('scripts')
<script>
$(document).ready(function() {
    // Character count for edit form description fields
    @foreach(getLanguages() as $language)
    $('#edit_translation_{{ $language->code }}_description').on('input', function() {
        var length = $(this).val().length;
        $('.edit-char-count-{{ $language->code }}').text(length);
    });
    @endforeach
});
</script>
@endpush