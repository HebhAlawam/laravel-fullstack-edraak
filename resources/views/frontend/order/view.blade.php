@extends('frontend.layouts.main')

@section('title')
    Order details
@endsection

@section('content')

<div class="container">

<div class="row">
        

        
        <div class="col-lg-9">
            <!-- items card -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center ">
                	<h6 class="font-weight-bold text-primary p-1"> The order has {{$order->orderItems->count()}} item(s) </h6>
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
		                      <th colspan="2">Total price</th>

		                    </tr>
	                  	</thead>
	                 	<tbody>
	                 		@foreach ($order->orderItems as $key => $item)
		                      <tr>
		                        <td> {{$key++}}</td>
		                        <td> {{$item->product->name}} </td>
		                        <td> {{ $item->product_price }} </td>
		                        <td> {{$item->product_qty}} </td>		
		                        <td> {{$item->product_price* $item->product_qty }} </td>		
		                        <td>
                      
                        <a href="{{route('product.detail',$item->product_id)}}"><i class="text-primary fa fa-eye"></i></a>
                      
  		            </td>			
		                      </tr>
							@endforeach
	                  	</tbody>
	                </table>
	              </div>
            	</div>
            </div>
		</div>
        


      

		 <div class="col-lg-3">
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
