{{-- Create Restaurant Modal --}}
<div class="modal fade" id="createRestaurantModal" tabindex="-1" aria-labelledby="createRestaurantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRestaurantModalLabel">Добавить новый ресторан</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        {{-- Brand tanlash --}}
                        <div class="col-md-6 mb-3">
                            <label for="brand_id" class="form-label">Бренд <span class="text-danger">*</span></label>
                            <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id" required>
                                <option value="">Выберите бренд</option>
                                @foreach(getBrands() as $brand)
                                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Branch Name --}}
                        <div class="col-md-6 mb-3">
                            <label for="branch_name" class="form-label">Название филиала <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('branch_name') is-invalid @enderror" id="branch_name" name="branch_name" value="{{ old('branch_name') }}" placeholder="Например: Чиланзар" required>
                        </div>
                    </div>

                    <div class="row">
                        {{-- City tanlash --}}
                        <div class="col-md-6 mb-3">
                            <label for="city_id" class="form-label">Город <span class="text-danger">*</span></label>
                            <select class="form-select @error('city_id') is-invalid @enderror" id="city_id" name="city_id" required>
                                <option value="">Выберите город</option>
                                @foreach(getCities() as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Categories (Multiple) --}}
                        <div class="col-md-6 mb-3">
                            <label for="categories" class="form-label">Категории</label>
                            <select class="form-select @error('categories') is-invalid @enderror" id="categories" name="categories[]" multiple>
                                @foreach(getCategories() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Удерживайте Ctrl, чтобы выбрать несколько</small>
                        </div>
                    </div>

                    {{-- Phone and Status --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Телефон</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="is_active" class="form-label">Статус</label>
                            <select class="form-select" name="is_active">
                                <option value="1">Активен</option>
                                <option value="0">Неактивен</option>
                            </select>
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Адрес (текст) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    {{-- Leaflet Map --}}
                    <div class="mb-3">
                        <label class="form-label">Укажите локацию на карте <span class="text-danger">*</span></label>
                        <div id="map" style="height: 300px; border-radius: 8px; border: 1px solid #ddd;"></div>
                        {{-- Yashirin inputlar koordinatalar uchun --}}
                        <input type="hidden" name="latitude" id="lat">
                        <input type="hidden" name="longitude" id="lng">
                    </div>

                    {{-- Multiple Images --}}
                    <div class="mb-3">
                        <label for="images" class="form-label">Галерея фотографий</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                        <div class="form-text">Первое выбранное фото будет обложкой (Cover).</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary w-100">Создать ресторан</button>
                </div>
            </form>
        </div>
    </div>
</div>