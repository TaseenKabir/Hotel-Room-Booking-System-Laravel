
        toastr.options.preventDuplicates = true;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //store product information
        $('form#product_store_form').on('submit', function(e) {
            e.preventDefault();
            let form = this;
            let formdata = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 1) {
                        toastr.success(data.message);
                        $(form)[0].reset();
                        table.ajax.reload(null, false);

                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                        $.fn.dataTable.ext.errMode = 'throw';

                    });
                }
            });
        });

        //Display saved products
        let table = $('#product_table').DataTable({
            processing: true,
            info: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            pageLength: 5,
            aLengthMenu: [
                [5, 10, 15, 20, 25, -1],
                [5, 10, 15, 20, 25, 'All']
            ],
            ajax: "{{route('product.get')}}",
            columns: [{
                    data: 'id',
                    name: 'id'
                }, {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ]

        });

        //EDIT Selected Product
        let modal = $('#editProductModal');

        $(document).on('click', 'button#editProductBtn', function() {
            let id = $(this).data('id');
            let url = "{{ route('product.edit')}}";

            let modal = $('#editProductModal');
            modal.find('form')[0].reset();
            modal.find('span.error-text').text('');
            modal.find('#editPreviewImage').hide();

            $.get(url, {
                id: id
            }, function(result) {
                modal.find('input[name="id"]').val(result.data.id);
                modal.find('input[name="name"]').val(result.data.name);
                modal.find('textarea[name="description"]').val(result.data.description);
                modal.find('input[name="price"]').val(result.data.price);
                modal.find('input[name="stock"]').val(result.data.stock);
                modal.find('input[name="sku"]').val(result.data.sku);
                modal.find('select[name="category_id"]').val(result.data.category_id);

                if (result.data.image) {
                    modal.find('#editPreviewImage')
                        .attr('src', "/images/" + result.data.image)
                        .show();
                }

                modal.modal('show');
            }, 'json');
        });



        //UPDATE The Selected Product Data
        $('form#product_update_form').on('submit', function(e) {
            e.preventDefault();
            // alert('Submit Now...');
            let form = this;
            let formdata = new FormData(form);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: formdata,
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 1) {
                        toastr.success(data.message);
                        table.ajax.reload(null, false);
                    }
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                }
            });
        });

        //Image preview on edit modal
        $(document).on('change', '#editImageInput', function(e) {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#editPreviewImage')
                        .attr('src', event.target.result)
                        .show();
                };
                reader.readAsDataURL(file);
            }
        });


        $('#addProductBtn').on('click', function() {
            $('#editPreviewImage').hide().attr('src', '');
        });

        function updateTrashCount() {
            $.get("{{ route('product.trash.count') }}", function(data) {
                $('#trashCount').text(data.count);
            });
        }

        $(document).on('click', '.deleteProductBtn', function() {
            let id = $(this).data('id');
            let url = "{{ route('product.delete') }}"; // POST route for deletion

            Swal.fire({
                title: "Are you sure?",
                html: "Proceed to delete the selected product.",
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#556ee5',
                cancelButtonColor: '#d33',
                width: 300,
                allowOutsideClick: false,
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}" // CSRF token
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 1) {
                                table.ajax.reload(null, false); // reload your DataTable
                                toastr.success(response.message);
                                updateTrashCount();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(xhr) {
                            toastr.error('Something went wrong!');
                        }
                    });
                }
            });
        });