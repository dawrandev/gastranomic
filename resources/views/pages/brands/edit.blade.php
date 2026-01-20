<div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBrandModalLabel">Редактировать бренд</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBrandForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_brand_id" name="brand_id">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="edit_name">Название <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                        <div class="invalid-feedback" id="error_name"></div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="edit_logo">Логотип</label>
                        <div class="mb-2">
                            <img id="current_logo_preview" src="" alt="Current logo" class="img-thumbnail" style="max-width: 100px; max-height: 100px; display: none;">
                        </div>
                        <input type="file" class="form-control" id="edit_logo" name="logo" accept="image/*">
                        <small class="form-text text-muted">Оставьте пустым, если не хотите менять. Форматы: jpg, jpeg, png, svg. Макс. размер: 2MB</small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="edit_description">Описание</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="4" placeholder="Краткое описание бренда"></textarea>
                        <small class="form-text text-muted">Максимум 1000 символов</small>
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