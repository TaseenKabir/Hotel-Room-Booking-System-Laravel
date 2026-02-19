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
        <div class="container-fluid d-flex justify-content-between align-items-center">

          <h2 class="h5 mb-0">Products</h2>

          <!-- Button to trigger modal -->
          <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#exampleModal" id="addProductBtn">
            <i class="fa fa-plus" aria-hidden="true"></i> Add
          </button>
        </div>
      </div>

      <!-- Main content -->

      @include('admin.fixed.footer')
    </div>
  </div>
  <!-- JavaScript files-->


</body>

</html>