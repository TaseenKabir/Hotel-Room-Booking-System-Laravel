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

          <h2 class="h5 mb-0">Messages</h2>
          <form id="searchForm" action="{{ route('message.view') }}" method="GET">
            @csrf
             <div class="search-container">
                <input name="search" type="search" placeholder="Search..." class="search-input" value="{{request('search')}}">
                <button type="submit" class="search-btn">
                    <i class="fa fa-search search-icon"></i>
                </button>
            </div>
          </form>
           

        </div>
      </div>

      <!-- Main content -->
        <section class="no-padding-top no-padding-bottom">
        <div class="row justify-content-center">
            <div class="container">
                <div class="card-body mb-30">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-lg" id="room_type_table">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->message}}</td>
                                    <td>
                                        <a href="{{ route('email.view', $item->id) }}"
                                            class="btn btn-success btn-sm" onclick="confirmation(event)">
                                            Send Email
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                           
                            
                        </table>
                         <div class="mt-3">
                                {{$data->links()}}
                            </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
      @include('admin.fixed.footer')
    </div>
    
  </div>
  <!-- JavaScript files-->


</body>

</html>