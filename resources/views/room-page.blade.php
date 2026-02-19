
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
            <div class="my-3">

               <div class="search-container">
                  <input 
                  id="search"
                  name="search" 
                  type="search" 
                  placeholder="Search..." 
                  class="search-input" 
                  value="{{request('search')}}">
                  <button type="submit" class="search-btn">
                        <i class="fa fa-search search-icon"></i>
                  </button>
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
                        <a href="{{ route('room.details', $room->id)}}" class="btn btn-primary mt-2">Book Now</a>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
      <!-- end our_room -->
      <!--  footer -->
      @include('home.footer')
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script type="text/javascript">
         $.ajaxSetup({ headers: {'csrftoken': '{{csrf_token()}}'}});
      </script>

      <script>
         $(document).ready(function() {
            
            $('#search').on('keyup', function() {
               var value = $(this).val();
               $.ajax({
                  type: 'GET',
                  url: '/search-rooms',
                  data: {'search': value},
                  success: function(data) {
                     $('.room-container').html(data);
                  }
               });
            });

         });
      </script>
   </body>
</html>