<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>keto</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

</head>
<body>
   <header>
   <!-- header inner -->
   <div class="header">
      <div class="container">
         <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
               <div class="full">
                  <div class="center-desk">
                     <div class="logo">
                        <a href="{{route('home.view')}}"><img src="{{ asset('images/logo.png')}}" alt="#" /></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
               <nav class="navigation navbar navbar-expand-md navbar-dark ">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarsExample04">
                     <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ request()->routeIs('home.view') ? 'active' : '' }}">
                           <a class="nav-link" href="{{route('home.view')}}">Home</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('rooms.view') ? 'active' : '' }}">
                           <a class="nav-link" href="{{route('rooms.view')}}">Our rooms</a>
                        </li>
                        
                        <li class="nav-item {{ request()->routeIs('contact.view') ? 'active' : '' }}">
                           <a class="nav-link" href="{{route('contact.view')}}">Contact Us</a>
                        </li>
                        @guest
                        <li class="nav-item {{ request()->routeIs('account.login','admin.login') ? 'active' : '' }}">
                           <a class="nav-link" href="{{ route('account.login') }}">Login</a>
                        </li>
                        @endguest

                        @auth
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown"
                              role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ Auth::user()->name }}
                           </a>

                           <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                              <li>
                                    <a class="dropdown-item" href="{{ route('account.dashboard') }}">
                                       My Account
                                    </a>
                              </li>
                              <li>
                                    <a class="dropdown-item" href="{{ route('account.logout') }}">
                                       Logout
                                    </a>
                              </li>
                           </ul>
                        </li>
                        @endauth


                     </ul>
                  </div>
               </nav>
            </div>
         </div>
      </div>
   </div>
</header>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
