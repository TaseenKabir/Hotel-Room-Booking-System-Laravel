<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dark Bootstrap Admin </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
  <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
  <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">

  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>

@include('admin.fixed.header')
    <div class="d-flex align-items-stretch">
        @include('admin.fixed.sidebar')
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid d-flex justify-content-between align-items-center">

                    <h2 class="h5 mb-0">Trash</h2>

                    <a href="{{ route('rooms.types') }}" class="btn btn-primary" type="button">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

            @if (Session::get('success'))
            <div class="alert alert-success">
                <strong><i class="fa fa-check-circle-o" aria-hidden="true"></i></strong>
                {!! Session::get('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if (Session::get('fail'))
            <div class="alert alert-danger">
                <strong><i class="fa fa-times" aria-hidden="true"></i></strong>
                {!! Session::get('fail') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="container">
                <div class="row justify-content-center">
                    <div class="table-responsive mt-3">
                <table class="table table-hover table-condensed table-lg">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roomTypes as $roomType)
                        <tr>
                            <td>{{ $roomType->id }}</td>

                            <td>
                                <img src="{{ asset('images/' . $roomType->image) }}"
                                    width="50" height="50">
                            </td>

                            <td>{{ $roomType->name }}</td>
                            <td>{{ $roomType->price }} ৳ </td>

                            <td>
                                <!-- Restore -->
                                <form action="{{ route('room-type.restore') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $roomType->id }}">
                                    <button type="submit"
                                        class="btn btn-sm btn-success"
                                        onclick="confirmation(event)">
                                        Restore
                                    </button>
                                </form>


                                <!-- Force Delete -->
                                <form action="{{ route('room-type.forceDelete') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $roomType->id }}">
                                    <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="confirmationDelete(event)">
                                        Delete 
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No trash found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                </div>
            </div>
            


        </div>
    </div>
    <!-- JavaScript files-->

  <script>
        function confirmation(ev) {
            ev.preventDefault();

            let form = ev.target.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will restore the room type',
                showCancelButton: true,
                confirmButtonText: 'Restore',
                cancelButtonText: 'Cancel',
                confirmButtonColor: 'rgba(12, 179, 3, 0.75)',
                cancelButtonColor: '#eb2222ff',
                width: 300,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function confirmationDelete(ev) {
            ev.preventDefault();

            let form = ev.target.closest('form');

            Swal.fire({
                title: 'Delete permanently?',
                text: 'This room type will be removed forever.',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                width: 320,
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    </body>