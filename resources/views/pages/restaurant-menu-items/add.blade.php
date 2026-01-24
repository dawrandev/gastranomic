<div class="modal fade" id="addMenuItemModal" tabindex="-1" aria-labelledby="addMenuItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('restaurant-menu-items.store') }}" method="POST" id="addMenuItemForm">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuItemModalLabel">Добавить блюдо в ресторан</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="menu_item_id" class="form-label">Блюдо <span class="text-danger">*</span></label>
                                <select class="form-control @error('menu_item_id') is-invalid @enderror" id="menu_item_id" name="menu_item_id" required>
                                    <option value="">Выберите блюдо</option>
                                    @foreach($availableMenuItems as $item)
                                    <option value="{{ $item->id }}" data-price="{{ $item->base_price }}">
                                        {{ $item->name }} ({{ $item->menuSection->name }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('menu_item_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($availableMenuItems->isEmpty())
                                <small class="text-muted">Все блюда уже добавлены!</small>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Цена (сум) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" min="0" step="0.01" required>
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Цена для этого филиала</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Статус</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1" checked>
                                    <label class="form-check-label" for="is_available">
                                        Доступно
                                    </label>
                                </div>
                                <small class="text-muted">Если блюдо закончилось, снимите галочку</small>
                            </div>

                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> <strong>Примечание:</strong> Вы можете добавлять только блюда вашего бренда.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 for menu item select
        if ($.fn.select2) {
            $('#menu_item_id').select2({
                placeholder: 'Выберите блюдо',
                allowClear: true,
                dropdownParent: $('#addMenuItemModal'),
                width: '100%'
            });
        }
    });

    // Auto-fill price when menu item selected
    $('#menu_item_id').on('change', function() {
        let selectedOption = $(this).find('option:selected');
        let basePrice = selectedOption.data('price');
        if (basePrice) {
            $('#price').val(basePrice);
        }
    });
</script>
@endpush
