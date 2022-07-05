@extends('frontend.layouts.main')


@section('title')
		Your cart
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div  class="col-lg-12">
      <div class="card mt-4">
        <form method="post" action="checkout1.html">
        	<div class="card-header d-flex flex-row p-2">
	          <h3>Shopping cart</h3>
	          <span class="text-muted ms-auto ">You currently have 
	          	{{App\Models\Cart::where('user_id',Auth::id())->count()}}
	           item(s) in your cart.</span>
         	 </div>
	          <div class="card-body">
	          	@if ($msg = Session::get('danger'))
				        <div class="alert alert-danger">
				          {{$msg}}
				        </div>  
				     @endif
	              <div class="table-responsive">
	                <table class="table" id="tableSum">

	                  <thead>
	                    <tr>
	                      <th >Product</th>
	                      <th >Name</th>
	                      <th>Quantity</th>
	                      <th>Size</th>
	                      <th>Unit price</th>
	                      <th>Total</th>
	                      <th></th>
	                      <th></th>

	                    </tr>
	                  </thead>
	                  <tbody>
	            			@forelse($cartProducts as $key => $cartProduct)
	                    <tr>
	                      <td><a href="#"><img src="{{asset('asset/uploads/products/'.$cartProduct->product->image)}}" width="40" alt="White Blouse Armani"></a></td>
	                      <td><h5> {{ $cartProduct->product->name }} </h5></td>
	                      <td> {{ $cartProduct->product_qty }} </td>
	                      <td> {{$cartProduct->product->size}} </td>
	                      <td>$ {{$cartProduct->product->price }} </td>
	                      <td> <span>$</span>
	                      	<span class="price"> {{ $cartProduct->product_qty * $cartProduct->product->price }}</span>
	                      </td>
	                      <td>
	                      		<a href="{{route('remove.cart',$cartProduct->id)}}"><i class="fa fa-trash-o text-danger"></i></a>
	                      </td>
	                      <td>
	                      		<a href="{{route('product.detail',$cartProduct->product_id)}}" ><i class="fa fa-eye text-primary me-1"></i></a>
	                      </td>
	                    </tr> 
	                    </tfoot>
	                   
	                  </tbody>
	                  
	                  @empty
	                 <div class="alert alert-light">No product in cart yet,
	                 	<a class="btn btn-secondary btn-sm" href="{{route('frontend')}}"> Add products now!</a>
	                 </div>
										@endforelse 

										<tfoot>
	                    <tr>
	                      <th colspan="5">Total price</th>
	                      <th colspan="2" id="totalPrice">
	                      	$0
	                      </th>
	                    </tr>
	                  </tfoot>
	                </table>

	              </div>
	          </div>
          <!-- /.table-responsive-->

          <div class="card-footer d-flex justify-content-between flex-column flex-lg-row">
            <div class="left"><a href="{{route('frontend')}}" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
            @if(App\Models\Cart::where('user_id',Auth::id())->count())
            <div class="right">
              <a href="{{route('checkout.page')}}" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></a>
            </div> 
            @endif
          </div>
        </form>
      </div>
    </div>
 
  </div>
</div>

@endsection


@section('script')

<script language="javascript" type="text/javascript">
    var spans = document.getElementById('tableSum').getElementsByTagName('span');
    var sum = 0;
    for(var i = 0; i < spans.length; i ++) {
        if(spans[i].className == 'price') {
           sum += isNaN(spans[i].innerHTML) ? 0 : parseInt(spans[i].innerHTML);
        }
    }
    document.getElementById('totalPrice').innerHTML = '$ ' + sum ;

</script>

@endsection

