   <!DOCTYPE html>
   <html lang="en">
   <head>
     @include('home.css')
      <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
   </head>
   <body>
      @include('home.header')
       <div class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Contact Us</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <form id="send_message" class="main_form" action="{{ route('send.message')}}" method="POST">
                     @csrf
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Name" type="type" name="name"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Email" type="type" name="email"> 
                        </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Phone Number" type="type" name="phone">                          
                        </div>
                        <div class="col-md-12">
                           <textarea class="textarea" placeholder="Message" type="type" name="message"></textarea>
                        </div>
                        <div class="col-md-12">
                           <button type="submit" class="send_btn">Send</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('home.footer')
      <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
      <script src="{{ asset('toastr/toastr.min.js') }}"></script>
      <script type="text/javascript">
         $('form#send_message').on('submit', function(e) {
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
      </script>
   </body>

   </html>
  
