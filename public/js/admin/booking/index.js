function confirm_delete(event) {
    event.preventDefault();
    const form = event.currentTarget.closest('.delete__form');
    const url = form.getAttribute('action');
    Swal.fire({
        title: 'ნამდვილად გსურთ წაშლა',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'დიახ',
        cancelButtonText: 'არა'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}