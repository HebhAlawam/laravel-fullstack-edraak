@extends('admin.layouts.main')

@section('content')


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
      <ol class="breadcrumb mt-2 me-5">
        <li class="breadcrumb-item "><a  href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item "><a  href="{{route('order.index')}}">Order</a></li>
        <li class="breadcrumb-item active" aria-current="page">All</li>
      </ol>
    </div>

    <div class="row justify-content-center">
      @include('admin.layouts.sidebar')

      <div class="col-md-10">
<div class="row">
        

        
        <div class="col-lg-8">
            <!-- items card -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center ">
                	<h6 class="font-weight-bold text-primary p-1"> The order has{{$order->orderItems->count()}} item(s) </h6>
                </div>

              	<div class="card-body">

	              <div class="table-responsive">
	                <table class="table align-items-center table-flush">
	                  	<thead class="thead-light">
		                    <tr>
		                      <th>#</th>
		                      <th>Name</th>
		                      <th>Unit price</th>                                     
		                      <th>Quantity</th>
		                    </tr>
	                  	</thead>
	                 	<tbody>
	                 		@foreach ($order->orderItems as $key => $item)

		                      <tr>
		                        <td> {{$key++}} </td>
		                        <td> {{$item->product->name}} </td>
		                        <td> {{ $item->product_price }}</td>
		                        <td> {{$item->product_qty}} </td>								
		                      </tr>
							@endforeach
	                  	</tbody>
	                </table>
	              </div>
            	</div>
            </div>
		</div>
        


      

		 <div class="col-lg-4">
		      <div class="card">
		        <div class="card-header p-2">
		          <h4 class="font-weight-bold text-primary p-2">Order summary</h4>
		        </div>
		        <div class="card-body">
		          <div class="table-responsive">
		            <table class="table">
		              <tbody>
		                <tr>
		                  <td class="text-muted">Order ID</td>
		                  <th>#{{$order->id}}</th>
		                  <input type="hidden" id="order_id" value="{{$order->id}}">
		                </tr>
		                <tr>
		                	<td class="text-muted">Customer name</td>
		                  	<th>{{$order->user->name}}</th>
		                </tr>
		            	<tr>
		                	<td class="text-muted">creation date</td>
		                  	<th>{{$order->created_at}}</th>
		                </tr>
		                <tr>
		                	<th >Total cost</th>
		                  	<th>${{$order->totalPrice}}</th>
		                </tr>
		                <tr>
		                	<th >Status</th>
		               		<td> <span class="badge bg-info text-dark p-2" id="status">{{$order->status}}</span> </td>
		                </tr>
		                <tr>
		                	<td colspan="2">
                            <select class="form-select selectStatus"  name="status">
							  <option selected>Change status</option>
							  <option value="Processing">Processing</option>
							  <option value="Shipped">Shipped</option>
							  <option value="Delivered">Delivered</option>
							  <option value="Completed">Completed</option>
							  <option value="Canceled">Canceled</option>
							</select>
						</td>
		                </tr>
		              </tbody>
		            </table>
		          </div>
		        </div>
		      </div>
		 </div>
    <!-- /.col-lg-3-->


</div>

    </div>
</div>
@endsection


@section('script')

<!-- change status -->
    <script type="text/javascript">
        
        $(document).ready(function () {
            $('.selectStatus').on('change',function(e) {
                var status = e.target.value;
                var order_id =$("#order_id").val();
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                }); 

                $.ajax({
                    url:"/admin/order/status",
                    type:"POST",
                    data: {
                        status: status,
                        order_id:order_id
                    },
                    success:function (data) {
                    	if (status == "Canceled") {
                    		swal("Are you sure you want to cancel this order?", {
							  buttons: ["Cancel", true],
							});
                    	} else {
                         swal(status);
                    	}
                        var content = document.getElementById("status");
                        content.innerHTML=status;
                    }
                })
            });
        });
    
    </script> 
@endsection


