{{-- QR Code Modal --}}
<div class="modal fade" id="qrcodeRestaurantModal" tabindex="-1" aria-labelledby="qrcodeRestaurantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="qrcodeRestaurantModalLabel">
                    <i class="fa fa-qrcode me-2"></i>QR-код ресторана
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h6 class="mb-3 fw-bold" id="qrcode-restaurant-name"></h6>

                    <div class="qr-code-container mb-3">
                        <img id="qrcode-image" src="" alt="QR-код" class="img-fluid border rounded p-3 shadow-sm" style="max-width: 300px; background: white;">

                        <div id="qrcode-no-image" class="alert alert-warning" style="display: none;">
                            <i class="fa fa-exclamation-triangle fa-3x mb-3 d-block"></i>
                            <p class="mb-0">QR-код не доступен для этого ресторана</p>
                        </div>
                    </div>

                    <div class="text-muted mb-2">
                        <small><i class="fa fa-info-circle me-1"></i>Отсканируйте QR-код для просмотра меню</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-1"></i> Закрыть
                </button>
                <a id="qrcode-download-link" href="" download class="btn btn-primary">
                    <i class="fa fa-download me-1"></i> Скачать QR-код
                </a>
            </div>
        </div>
    </div>
</div>
