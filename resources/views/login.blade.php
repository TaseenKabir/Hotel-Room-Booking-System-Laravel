<!doctype html>
<html lang="en">
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="all,follow">
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    


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
                                        @if (Session::has('success'))
                                            <div class="alert alert-success">{{ Session::get('success')}}</div>
                                        @endif 

                                        @if (Session::has('error'))
                                            <div class="alert alert-danger">{{ Session::get('error')}}</div>
                                        @endif 
                                        <div class="mb-5">
                                            <h4 class="text-center">User Login</h4>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('account.authenticate')}}" method="POST">
                                    @csrf
                                    <div class="row gy-3 overflow-hidden">
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
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                name="password" id="password" value="" placeholder="Password">
                                                <label for="password" class="form-label">Password</label>
                                                @error('password')
                                                    <p class="invalid-feedback">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Log in now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <hr class="mt-5 mb-4 border-secondary-subtle">
                                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                            <a href=" {{ route('account.register')}}" class="link-secondary text-decoration-none">Create new account</a>
                                        </div>
                                        <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center mt-4">
                                            <p>Are you an admin?</p><a href=" {{ route('admin.login')}}" class="link-secondary text-decoration-none">Click here to login</a>
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
<script src="{{ asset('admin/js/front.js') }}"></script>
</body>
</html>