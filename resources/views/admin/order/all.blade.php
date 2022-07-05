@extends('admin.layouts.main')

@section('content')



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
      <ol class="breadcrumb mt-2 me-5">
        <li class="breadcrumb-item"><a  href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a  href="{{route('order.index')}}">Order</a></li>
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
                <h6 class="m-0 font-weight-bold text-primary">Customer orders</h6>

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
                      <th>#ID</th>
                      <th>Customer name</th>
                      <th>creation date</th>                                     
                      <th>Num items</th>
                      <th>Total cost</th>
                      <th colspan="3">status</th>

                    </tr>
                  </thead>
                  <tbody>

                    @forelse ($orders as $order)
                      <tr>
                        <td>{{ ($orders->currentPage()-1) * $orders->perPage() + $loop->index + 1 }}</td>
                        <td>{{$order->id}}</td>
                        <td>{{ $order->user->name }}</td>

                        <td> {{$order->created_at}} </td>
                        <td> {{$order->orderItems->count()}}</td>
                        <td> {{$order->totalPrice}}</td>
                        <td> {{$order->status}} </td>

                         <td>
                            <div class="col-6 col-sm-4">
                              <a href="{{ route('admin.order.view',$order->id) }}"><i class="text-primary fa fa-eye"></i></a>
                            </div>
						</td>
                      </tr>

                    @empty
                    <td>No order created yet!</td>
                    @endforelse
                  </tbody>
                </table>
                {!! $orders->links() !!}
              </div>
            </div>
            </div>
          </div>
        </div>


      </div>
    </div>
</div>
@endsection
