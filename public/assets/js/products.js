$(document).ready(function() {
    $('#products-table').DataTable({
        columnDefs: [
            { orderable: false, targets: 4 }
        ]
    });

    $('.delete-product').on('click', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleting...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: { 
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id
                     },
                    success: function() {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your product has been deleted.',
                            icon: 'success'
                        }).then(function() {
                            window.location.href = indexUrl;
                        });
                    }
                });
            }
        });
    });
});