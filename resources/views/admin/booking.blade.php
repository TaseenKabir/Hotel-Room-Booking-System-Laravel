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

                    <h2 class="h5 mb-0">Booking Details</h2>

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

                    </div>
                </div>
            </div>

            <section class="no-padding-top no-padding-bottom">
                <div class="row justify-content-center">
                    <div class="container">
                        <div class="card-body mb-30">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-lg" id="room_type_table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Room ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Room Name</th>
                                            <th scope="col">Arrival</th>
                                            <th scope="col">Departure</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $data)
                                        <tr>
                                            <td>{{$data->room_type_id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->phone}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->room->name}}</td>
                                            <td>{{$data->check_in}}</td>
                                            <td>{{$data->check_out}}</td>
                                           <td>
                                                <a href="{{ route('booking.delete', $data->id) }}"
                                                    class="text-dark mx-2" onclick="confirmation(event)">
                                                    <i class="fa fa-trash" data-bs-toggle="tooltip" title="Delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                   
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
        function confirmation(ev) {
            ev.preventDefault();

            let urlToRedirect = ev.currentTarget.getAttribute('href');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete the booking',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#008a4eff',
                width: 300,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
    

</body>

</html>