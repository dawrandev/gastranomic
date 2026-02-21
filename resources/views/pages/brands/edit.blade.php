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
                        <label for="edit_logo">Логотип</label>
                        <div class="mb-2">
                            <img id="current_logo_preview" src="" alt="Current logo" class="img-thumbnail" style="max-width: 100px; max-height: 100px; display: none;">
                        </div>
                        <input type="file" class="form-control" id="edit_logo" name="logo" accept="image/*">
                        <small class="form-text text-muted">Оставьте пустым, если не хотите менять. Форматы: jpg, jpeg, png, svg. Макс. размер: 2MB</small>
                    </div>

                    <!-- Translation sections for each language -->
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="edit-uz-tab" data-bs-toggle="tab" data-bs-target="#edit-uz-content" type="button" role="tab">Ўзбек</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="edit-ru-tab" data-bs-toggle="tab" data-bs-target="#edit-ru-content" type="button" role="tab">Русский</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="edit-kk-tab" data-bs-toggle="tab" data-bs-target="#edit-kk-content" type="button" role="tab">Қарақалпақ</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="edit-en-tab" data-bs-toggle="tab" data-bs-target="#edit-en-content" type="button" role="tab">English</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Uzbek -->
                        <div class="tab-pane fade show active" id="edit-uz-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="edit_uz_name">Название <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit_uz_name" name="translations[uz][name]" required>
                                <div class="invalid-feedback" id="error_uz_name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_uz_description">Описание</label>
                                <textarea class="form-control" id="edit_uz_description" name="translations[uz][description]" rows="4" placeholder="Краткое описание бренда"></textarea>
                                <small class="form-text text-muted">Максимум 1000 символов</small>
                            </div>
                        </div>

                        <!-- Russian -->
                        <div class="tab-pane fade" id="edit-ru-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="edit_ru_name">Название</label>
                                <input type="text" class="form-control" id="edit_ru_name" name="translations[ru][name]">
                                <div class="invalid-feedback" id="error_ru_name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_ru_description">Описание</label>
                                <textarea class="form-control" id="edit_ru_description" name="translations[ru][description]" rows="4" placeholder="Краткое описание бренда"></textarea>
                                <small class="form-text text-muted">Максимум 1000 символов</small>
                            </div>
                        </div>

                        <!-- Karakalpak -->
                        <div class="tab-pane fade" id="edit-kk-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="edit_kk_name">Название</label>
                                <input type="text" class="form-control" id="edit_kk_name" name="translations[kk][name]">
                                <div class="invalid-feedback" id="error_kk_name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_kk_description">Описание</label>
                                <textarea class="form-control" id="edit_kk_description" name="translations[kk][description]" rows="4" placeholder="Краткое описание бренда"></textarea>
                                <small class="form-text text-muted">Максимум 1000 символов</small>
                            </div>
                        </div>

                        <!-- English -->
                        <div class="tab-pane fade" id="edit-en-content" role="tabpanel">
                            <div class="form-group mb-3">
                                <label for="edit_en_name">Название</label>
                                <input type="text" class="form-control" id="edit_en_name" name="translations[en][name]">
                                <div class="invalid-feedback" id="error_en_name"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="edit_en_description">Описание</label>
                                <textarea class="form-control" id="edit_en_description" name="translations[en][description]" rows="4" placeholder="Краткое описание бренда"></textarea>
                                <small class="form-text text-muted">Максимум 1000 символов</small>
                            </div>
                        </div>
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