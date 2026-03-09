<script>
    document.addEventListener('DOMContentLoaded', function() {

        // DELETE CONFIRMATION - Danger style (using event delegation for AJAX-loaded content)
        document.addEventListener('click', function(e) {
            const button = e.target.closest('.btn-delete-confirm');
            if (!button) return;

            e.preventDefault();

            const formId = button.getAttribute('data-form-id');
            const title = button.getAttribute('data-title') || 'Вы уверены?';
            const text = button.getAttribute('data-text') || 'Это действие нельзя отменить!';
            const confirmText = button.getAttribute('data-confirm-text') || 'Да, удалить';
            const cancelText = button.getAttribute('data-cancel-text') || 'Отмена';

            swal({
                title: title,
                text: text,
                icon: "warning",
                buttons: {
                    cancel: {
                        text: cancelText,
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: confirmText,
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: true
                    }
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    document.getElementById(formId).submit();
                }
            });
        });

        // GENERAL CONFIRMATION - Info/Question style (using event delegation)
        document.addEventListener('click', function(e) {
            const button = e.target.closest('.btn-confirm');
            if (!button) return;

            e.preventDefault();

            const formId = button.getAttribute('data-form-id');
            const title = button.getAttribute('data-title') || 'Вы уверены?';
            const text = button.getAttribute('data-text') || '';
            const icon = button.getAttribute('data-icon') || 'info';
            const confirmText = button.getAttribute('data-confirm-text') || 'Да';
            const cancelText = button.getAttribute('data-cancel-text') || 'Нет';

            swal({
                title: title,
                text: text,
                icon: icon,
                buttons: {
                    cancel: {
                        text: cancelText,
                        value: null,
                        visible: true,
                        closeModal: true,
                    },
                    confirm: {
                        text: confirmText,
                        value: true,
                        visible: true,
                        closeModal: true
                    }
                }
            }).then((result) => {
                if (result) {
                    document.getElementById(formId).submit();
                }
            });
        });

        // SUCCESS CONFIRMATION (using event delegation)
        document.addEventListener('click', function(e) {
            const button = e.target.closest('.btn-success-confirm');
            if (!button) return;

            e.preventDefault();

            const formId = button.getAttribute('data-form-id');
            const title = button.getAttribute('data-title') || 'Готово!';
            const text = button.getAttribute('data-text') || '';
            const confirmText = button.getAttribute('data-confirm-text') || 'Продолжить';
            const cancelText = button.getAttribute('data-cancel-text') || 'Отмена';

            swal({
                title: title,
                text: text,
                icon: "success",
                buttons: {
                    cancel: {
                        text: cancelText,
                        value: null,
                        visible: true,
                        closeModal: true,
                    },
                    confirm: {
                        text: confirmText,
                        value: true,
                        visible: true,
                        className: "btn-success",
                        closeModal: true
                    }
                }
            }).then((result) => {
                if (result) {
                    document.getElementById(formId).submit();
                }
            });
        });
    });
</script>
