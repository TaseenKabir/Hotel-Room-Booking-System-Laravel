
<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.css')
      <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      @include('home.header')
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      @include('home.banner')
      <!-- end banner -->
      <!-- about -->
      @include('home.about')
      <!-- end about -->
      <!-- our_room -->
      <div  class="our_room">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Our Rooms</h2>
                     <p>Best Rooms at the Best Price </p>
                  </div>
               </div>
            </div>
            <div class="row g-4 room-container">
               @foreach($rooms as $room)
               <div class="col-md-4 col-sm-6">
                  <div id="serv_hover"  class="room">
                     <div class="room_img">
                        <figure><img src="images/{{$room->image}}" alt="#"/></figure>
                     </div>
                     <div class="bed_room">
                        <h3>{{$room->name}}</h3>
                        <h4>{{$room->price}} /-</h4>
                        <p>{!! Str::limit($room->description, 100) !!} </p>
                        <a href="{{ route('room.details', $room->id)}}" class="btn btn-primary">Book Now</a>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
            <div class="text-center m-3">
               <a class="btn btn-primary" href="{{route('rooms.view')}}">View All</a>
            </div>
         </div>
      </div>
      <!-- end our_room -->
      <!-- blog -->
      @include('home.blog')
      <!-- end blog -->
      <!--  contact -->

      <!-- end contact -->
      <!--  footer -->
      @include('home.footer')
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>