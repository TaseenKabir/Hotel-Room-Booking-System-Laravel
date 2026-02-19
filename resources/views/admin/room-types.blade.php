<!DOCTYPE html>
<html>
<body>
    @include('admin.fixed.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.fixed.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid d-flex justify-content-between align-items-center">

                    <h2 class="h5 mb-0">Room Types</h2>

                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" id="addRoomBtn">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add
                    </button>
                </div>
            </div>

            <!-- Main content -->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-light" id="exampleModalLabel">Room Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('room-type.store')}}" method="POST" id="room_store_form" enctype="multipart/form-data">
                            @csrf

                            <div class="modal-body">
                                <div class="row justify-content-center">

                                    <!-- Left Column -->
                                    <div class="mb-3">
                                        <input type="hidden" name="id">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center mb-3">
                                            <img id="editPreviewImage"
                                                src=""
                                                style="width:130px; height:130px; object-fit:cover; border-radius:6px; display:none;">
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Image</label>
                                            <input name="image" class="form-control" type="file" id="editImageInput">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control">
                                            <span class="text-danger error-text name_error"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <span class="text-danger error-text description_error"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" name="price" class="form-control">
                                            <span class="text-danger error-text price_error"></span>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Capacity</label>
                                            <input type="number" name="max_capacity" class="form-control">
                                            <span class="text-danger error-text max_capacity_error"></span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary btn-success">Save</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>

            <section class="no-padding-top no-padding-bottom">
                <div class="row justify-content-center">
                    <div class="container">
                        <div class="card-body mb-30">

                            <div class="d-flex justify-content-end mb-4">
                                <a href="{{ route('room-type.trash')}}" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Trash ( <span id="trashCount"></span> )
                                </a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-lg" id="room_type_table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Capacity</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                   
                                </table>


                            </div>

                        </div>
                    </div>
                </div>
            </section>
            @include('admin.fixed.footer')
        </div>
    </div>

    @include('admin.edit-room-types')

    <!-- JavaScript files-->
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/charts-home.js') }}"></script>
    <script src="{{ asset('admin/js/front.js') }}"></script>
    <script>
        toastr.options.preventDuplicates = true;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //store room information
        $('form#room_store_form').on('submit', function(e) {
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

        //Display saved room types
        let table = $('#room_type_table').DataTable({
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
            ajax: "{{route('room-type.get')}}",
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
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'max_capacity',
                    name: 'max_capacity'
                },
                {
                    data: 'actions',
                    name: 'actions'
                },
            ]

        });

        //EDIT Selected Room type
        let modal = $('#editRoomTypeModal');

        $(document).on('click', 'button#editRoomBtn', function() {
            let id = $(this).data('id');
            let url = "{{ route('room-type.edit')}}";

            let modal = $('#editRoomTypeModal');
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
                modal.find('input[name="max_capacity"]').val(result.data.max_capacity);

                if (result.data.image) {
                    modal.find('#editPreviewImage')
                        .attr('src', "/images/" + result.data.image)
                        .show();
                }

                modal.modal('show');
            }, 'json');
        });



        //UPDATE The Selected room type Data
        $('form#room_type_update_form').on('submit', function(e) {
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


        $('#addRoomBtn').on('click', function() {
            $('#editPreviewImage').hide().attr('src', '');
        });

        function updateTrashCount() {
            $.get("{{ route('room-type.trash.count') }}", function(data) {
                $('#trashCount').text(data.count);
            });
        }

        $(document).on('click', '.deleteRoomBtn', function() {
            let id = $(this).data('id');
            let url = "{{ route('room-type.delete') }}"; // POST route for deletion

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
    </script>

</body>

</html>