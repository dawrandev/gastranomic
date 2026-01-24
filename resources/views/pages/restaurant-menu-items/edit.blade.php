<div class="modal fade" id="editMenuItemModal" tabindex="-1" aria-labelledby="editMenuItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" id="editMenuItemForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_rmi_id" name="rmi_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="editMenuItemModalLabel">Редактировать блюдо</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_menu_item_name" class="form-label">Блюдо</label>
                        <input type="text" class="form-control" id="edit_menu_item_name" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="edit_price" class="form-label">Цена (сум) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_price" name="price" min="0" step="0.01" required>
                        <small class="text-muted">Цена для этого филиала</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="edit_is_available" name="is_available" value="1">
                            <label class="form-check-label" for="edit_is_available">
                                Доступно
                            </label>
                        </div>
                        <small class="text-muted">Если блюдо закончилось, снимите галочку</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Обновить</button>
                </div>
            </form>
        </div>
    </div>
</div>
