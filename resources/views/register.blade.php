<!doctype html>
<html lang="en">
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
  <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
  <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">

  <!-- Tweaks for older IEs--><!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
@include('home.header')
    <body class="bg-light">
        <section class=" p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5">
                                            <h4 class="text-center">Register Here</h4>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('account.processRegister') }}" method="POST">
                                    @csrf
                                    <div class="row gy-3 overflow-hidden">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="{{ old('name')}}" class="form-control @error('name') is-invalid @enderror" 
                                                name="name" id="name" placeholder="Enter name">
                                                <label for="name" class="form-label">Name</label>
                                                @error('name')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="{{ old('email')}}" class="form-control @error('email') is-invalid @enderror" 
                                                name="email" id="email" placeholder="name@example.com">
                                                <label for="email" class="form-label">Email</label>
                                                @error('email')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" value="{{ old('phone')}}" class="form-control @error('phone') is-invalid @enderror" 
                                                name="phone" id="phone" placeholder="Enter your phone number">
                                                <label for="phone" class="form-label">Phone</label>
                                                @error('phone')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                name="password" id="password" value="" placeholder="Password">
                                                <label for="password" class="form-label">Password</label>
                                                @error('password')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                name="password_confirmation" id="password_confirmation" value="" placeholder="Confirm Password" >
                                                <label for="password" class="form-label">Confirm Password</label>
                                                @error('password_confirmation')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Register Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-5 mb-4 border-secondary-subtle">
                                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                            <a href=" {{ route('account.login')}} " class="link-secondary text-decoration-none">Click here to login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
<script src="{{ asset('admin/js/front.js') }}"></script>    </body>
</html>