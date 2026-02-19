<!DOCTYPE html>
<html>
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
<body>
  @include('admin.fixed.header')
  <div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    @include('admin.fixed.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid d-flex justify-content-center align-items-center">

          <h2 class="h5 mb-0">Send Email to {{$data->name}}</h2>

        </div>
      </div>

      <!-- Main content -->
        <section>
            <div class="container">
                <div class="row">
                    <form action="{{ route('send.email',$data->id)}}" method="POST" id="room_store_form" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row justify-content-center">

                                <!-- Left Column -->
                                <div class="mb-3">
                                    <input type="hidden" name="id">
                                </div>
                                <div class="col-md-6">
                                
                                    <div class="mb-3">
                                        <label class="form-label">Greeting</label>
                                        <input type="text" name="greeting" class="form-control">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Mail Body</label>
                                        <textarea name="mail_body" class="form-control" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <span class="text-danger error-text description_error"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Action Text</label>
                                        <input type="text" name="action_text" class="form-control">
                                        <span class="text-danger error-text price_error"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Action Url</label>
                                        <input type="text" name="action_url" class="form-control">
                                        <span class="text-danger error-text max_capacity_error"></span>
                                    </div>

                                     <div class="mb-3">
                                        <label class="form-label">End Line</label>
                                        <input type="text" name="end_line" class="form-control">
                                        <span class="text-danger error-text max_capacity_error"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" text-center m-3">
                            <button type="submit" class="btn btn-primary btn-success">Send Email</button>
                        </div>

                    </form>
                </div>
            </div>
        </section>
      @include('admin.fixed.footer')
    </div>
  </div>
  <!-- JavaScript files-->


</body>

</html>