window.showSuccess = function(message) {
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: message,
        timer: 2500,
        showConfirmButton: false
    });
};

window.showWarning = function(message) {
    Swal.fire({
        icon: 'warning',
        title: 'Atención',
        text: message
    });
};

window.showError = function(message, title = '¡Oops...!') {
    Swal.fire({
        icon: 'error',
        title: title,
        html: message,
        confirmButtonText: 'Aceptar'
    });
};

$(document).ready(function() {
    $('.datatable').DataTable({ /* ... */ });
    $(document).on('click', '.btn-delete', function(e) { /* ... */ });

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const form = $(this).closest('form');
    
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });

});