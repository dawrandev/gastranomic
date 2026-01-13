// Permissionlarni data atributlardan olish
const getPermissions = () => {
    const container = document.querySelector('.container-fluid[data-can-edit]');
    if (!container) return {};

    return {
        canEdit: container.dataset.canEdit === '1',
        canDelete: container.dataset.canDelete === '1',
        canView: container.dataset.canView === '1',
        canCreate: container.dataset.canCreate === '1',
    };
};

// Tooltip'larni faollashtirish
const initTooltips = () => {
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map((tooltipTriggerEl) => {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
};

// Edit modalini ma'lumotlar bilan to'ldirish
const initEditModal = () => {
    const editModal = document.getElementById('editRestaurantModal');
    if (!editModal) return;

    editModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const phone = button.getAttribute('data-phone');
        const address = button.getAttribute('data-address');
        const isActive = button.getAttribute('data-is-active');

        document.getElementById('edit-id').value = id;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-phone').value = phone;
        document.getElementById('edit-address').value = address;
        document.getElementById('edit-is-active').value = isActive;
    });
};

// Show modalini ma'lumotlar bilan to'ldirish
const initShowModal = () => {
    const showModal = document.getElementById('showRestaurantModal');
    if (!showModal) return;

    showModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const permissions = getPermissions();

        // Ma'lumotlarni olish
        const data = {
            id: button.getAttribute('data-id'),
            name: button.getAttribute('data-name'),
            phone: button.getAttribute('data-phone'),
            description: button.getAttribute('data-description'),
            address: button.getAttribute('data-address'),
            longitude: button.getAttribute('data-longitude'),
            latitude: button.getAttribute('data-latitude'),
            isActive: button.getAttribute('data-is-active'),
            qrCode: button.getAttribute('data-qr-code'),
        };

        // Asosiy ma'lumotlarni to'ldirish
        document.getElementById('show-id').value = data.id;
        document.getElementById('show-name').textContent = data.name;
        document.getElementById('show-phone').textContent = data.phone || 'N/A';
        document.getElementById('show-description').textContent =
            data.description || 'Нет описания';
        document.getElementById('show-address').textContent = data.address || 'N/A';
        document.getElementById('show-longitude').textContent =
            data.longitude || 'N/A';
        document.getElementById('show-latitude').textContent =
            data.latitude || 'N/A';

        // Statusni ko'rsatish
        const statusElement = document.getElementById('show-status');
        if (data.isActive === '1') {
            statusElement.textContent = 'Активен';
            statusElement.className = 'badge bg-success';
        } else {
            statusElement.textContent = 'Неактивен';
            statusElement.className = 'badge bg-danger';
        }

        // QR kodni ko'rsatish
        const qrCodeElement = document.getElementById('show-qr-code');
        const noQrCodeElement = document.getElementById('no-qr-code');
        if (data.qrCode) {
            qrCodeElement.src = `/storage/qr_codes/${data.qrCode}`;
            qrCodeElement.style.display = 'block';
            if (noQrCodeElement) noQrCodeElement.style.display = 'none';
        } else {
            qrCodeElement.style.display = 'none';
            if (noQrCodeElement) noQrCodeElement.style.display = 'block';
        }

        // Xaritani yuklash
        const mapContainer = document.getElementById('show-map-container');
        if (data.longitude && data.latitude) {
            const mapElement = document.getElementById('show-map');
            mapElement.innerHTML = `
        <iframe 
          width="100%" 
          height="300" 
          frameborder="0" 
          style="border:0" 
          src="https://maps.google.com/maps?q=${data.latitude},${data.longitude}&z=15&output=embed" 
          allowfullscreen>
        </iframe>
      `;
            if (mapContainer) mapContainer.style.display = 'block';
        } else {
            if (mapContainer) mapContainer.style.display = 'none';
        }

        // Rasmlarni yuklash
        const imagesContainer = document.getElementById('show-images');
        if (imagesContainer) {
            imagesContainer.innerHTML = `
        <div class="col-md-4 mb-3">
          <img src="https://picsum.photos/seed/${data.id}/400/300.jpg" class="img-fluid rounded" alt="${data.name}">
        </div>
        <div class="col-md-4 mb-3">
          <img src="https://picsum.photos/seed/${data.id}2/400/300.jpg" class="img-fluid rounded" alt="${data.name}">
        </div>
        <div class="col-md-4 mb-3">
          <img src="https://picsum.photos/seed/${data.id}3/400/300.jpg" class="img-fluid rounded" alt="${data.name}">
        </div>
      `;
        }

        // Tahrirlash va o'chirish tugmalarini permissionlarga qarab ko'rsatish
        const editButton = document.getElementById('show-edit-button');
        const deleteButton = document.getElementById('show-delete-button');

        if (editButton) {
            if (permissions.canEdit) {
                editButton.style.display = 'inline-block';
                editButton.setAttribute('data-id', data.id);
            } else {
                editButton.style.display = 'none';
            }
        }

        if (deleteButton) {
            if (permissions.canDelete) {
                deleteButton.style.display = 'inline-block';
                deleteButton.setAttribute('data-id', data.id);
                deleteButton.setAttribute('data-name', data.name);
            } else {
                deleteButton.style.display = 'none';
            }
        }
    });
};

// Barcha funksiyalarni ishga tushirish
document.addEventListener('DOMContentLoaded', () => {
    initTooltips();
    initEditModal();
    initShowModal();
});