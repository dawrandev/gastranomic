{{-- Show Restaurant Modal --}}
<div class="modal fade" id="showRestaurantModal" tabindex="-1" aria-labelledby="showRestaurantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showRestaurantModalLabel">Информация о ресторане</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="show-id" name="id">

                <div class="row">
                    <div class="col-md-8">
                        <h4 id="show-name" class="mb-3"></h4>

                        <div class="mb-4">
                            <h6>Описание</h6>
                            <p id="show-description" class="text-muted"></p>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6>Контактная информация</h6>
                                <p class="mb-2">
                                    <i class="fa fa-phone me-2 text-primary"></i>
                                    <span id="show-phone"></span>
                                </p>
                                <p class="mb-2">
                                    <i class="fa fa-map-marker-alt me-2 text-primary"></i>
                                    <span id="show-address"></span>
                                </p>
                                <p class="mb-2">
                                    <i class="fa fa-globe me-2 text-primary"></i>
                                    Координаты: <span id="show-latitude"></span>, <span id="show-longitude"></span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6>Статус</h6>
                                <span id="show-status" class="badge"></span>

                                <h6 class="mt-3">QR-код</h6>
                                <div id="qr-code-container">
                                    <img id="show-qr-code" src="" alt="QR-код" class="img-fluid" style="max-width: 150px;">
                                    <div id="no-qr-code" class="text-muted" style="display: none;">QR-код не доступен</div>
                                </div>
                            </div>
                        </div>

                        <div id="show-map-container" class="mb-4">
                            <h6>Расположение на карте</h6>
                            <div id="show-map"></div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <h6>Фотографии ресторана</h6>
                        <div class="row" id="show-images">
                            <!-- Rasmlar JavaScript orqali yuklanadi -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть</button>

                {{-- Tahrirlash tugmasi - 'restaurant-edit' ruhsati talab qilinadi --}}
                @if(auth()->user()->hasPermissionTo('restaurant-edit'))
                <button type="button"
                    id="show-edit-button"
                    class="btn btn-outline-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#editRestaurantModal"
                    data-bs-dismiss="modal">
                    <i class="fa fa-edit"></i> Редактировать
                </button>
                @endif

                {{-- O'chirish tugmasi - 'restaurant-delete' ruhsati talab qilinadi --}}
                @if(auth()->user()->hasPermissionTo('restaurant-delete'))
                <form id="show-delete-form" action="" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        id="show-delete-button"
                        class="btn btn-outline-danger"
                        onclick="return confirm('Вы действительно хотите удалить этот ресторан?')">
                        <i class="fa fa-trash"></i> Удалить
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>