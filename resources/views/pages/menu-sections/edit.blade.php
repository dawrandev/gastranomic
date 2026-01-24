<div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="POST" id="editSectionForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_section_id" name="section_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="editSectionModalLabel">Редактировать раздел меню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Название раздела (на разных языках) <span class="text-danger">*</span></label>
                        @foreach($languages as $lang)
                        <div class="input-group mb-2">
                            <span class="input-group-text" style="min-width: 100px;">{{ $lang->name }}</span>
                            <input type="text"
                                class="form-control"
                                id="edit_name_{{ $lang->code }}"
                                name="translations[{{ $lang->code }}][name]"
                                placeholder="Название на {{ $lang->name }}"
                                required>
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="edit_sort_order" class="form-label">Порядок сортировки</label>
                        <input type="number" class="form-control" id="edit_sort_order" name="sort_order" min="0">
                        <small class="text-muted">Разделы отображаются в этом порядке</small>
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
