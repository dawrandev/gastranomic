<div class="modal fade" id="createSectionModal" tabindex="-1" aria-labelledby="createSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('menu-sections.store') }}" method="POST" id="createSectionForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createSectionModalLabel">Новый раздел меню</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Название раздела (на разных языках) <span class="text-danger">*</span></label>
                        @foreach($languages as $lang)
                        <div class="input-group mb-2">
                            <span class="input-group-text" style="min-width: 100px;">{{ $lang->name }}</span>
                            <input type="text"
                                class="form-control @error('translations.'.$lang->code.'.name') is-invalid @enderror"
                                name="translations[{{ $lang->code }}][name]"
                                value="{{ old('translations.'.$lang->code.'.name') }}"
                                placeholder="Название на {{ $lang->name }}"
                                required>
                            @error('translations.'.$lang->code.'.name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Порядок сортировки</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Разделы отображаются в этом порядке</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
