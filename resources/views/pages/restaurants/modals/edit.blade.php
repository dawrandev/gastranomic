{{-- Edit Restaurant Modal --}}
<div class="modal fade" id="editRestaurantModal" tabindex="-1" aria-labelledby="editRestaurantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRestaurantModalLabel">Редактировать ресторан</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('restaurants.update', '') }}" method="POST" enctype="multipart/form-data" id="edit-restaurant-form">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-name" class="form-label">Название ресторана <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-phone" class="form-label">Телефон</label>
                            <input type="text" class="form-control" id="edit-phone" name="phone">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-address" class="form-label">Адрес <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit-address" name="address" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit-image" class="form-label">Изображение</label>
                            <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                            <div class="form-text">Допустимые форматы: JPG, PNG, GIF. Максимальный размер: 2MB. Оставьте пустым, чтобы сохранить текущее изображение.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-is-active" class="form-label">Статус</label>
                            <select class="form-select" id="edit-is-active" name="is_active">
                                <option value="1">Активен</option>
                                <option value="0">Неактивен</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Описание</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>