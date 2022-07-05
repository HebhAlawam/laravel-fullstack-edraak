@extends('admin.layouts.main')

@section('content')



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
      <ol class="breadcrumb mt-2 me-5">
        <li class="breadcrumb-item"><a  href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a  href="{{route('all.user')}}">User</a></li>
        <li class="breadcrumb-item active" aria-current="page">All</li>
      </ol>
    </div>

    <div class="row justify-content-center">
      @include('admin.layouts.sidebar')

      <div class="col-md-10">
        <div class="row">
          <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All user</h6>

              </div>

              <div class="card-body">

              @if ($msg = Session::get('success'))
                <div class="alert alert-info">
                  {{$msg}}
                </div>  
              @endif

              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>SN</th>
                      <th>Customer name</th>
                                    
                      <th>Num of order</th>
                      <th>Status</th>                                     

                    </tr>
                  </thead>
                  <tbody>

                    @forelse ($users as $user)
                      <tr>
                        <td>{{ ($users->currentPage()-1) * $users->perPage() + $loop->index + 1 }}</td>
                        <td>{{$user->name}}</td>
                        <td> {{$user->orders_count}}</td>
                        <td><input type="checkbox" data-id="{{ $user->id }}" name="status" class="js-switch" {{ $user->status == 1 ? 'checked' : '' }}></td>
                      </tr>

                    @empty
                    <td>No order created yet!</td>
                    @endforelse
                  </tbody>
                </table>

              </div>
            </div>
            </div>
          </div>
        </div>


      </div>
    </div>
</div>
@endsection


@section('script')
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
  <script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });
  
    $(document).ready(function(){
      $('.js-switch').change(function () {
          let status = $(this).prop('checked') === true ? 1 : 0;
          let userId = $(this).data('id');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: '{{ route('user.update.status') }}',
              data: {'status': status, 'user_id': userId },
              success: function (data) {
                  toastr.options.closeButton = true;
                  toastr.options.closeMethod = 'fadeOut';
                  toastr.options.closeDuration = 100;
                  toastr.success(data.message);
              }
          });
      });
    });

  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@endsection

