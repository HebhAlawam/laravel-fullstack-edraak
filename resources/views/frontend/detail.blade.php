@extends('frontend.layouts.main')

@section('title')
	 {{$product->name}}
@endsection

@section('content')


<div class="container">
	<div class="card shadow product_data">
		 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		 	<h2 class="mb-0 font-weight-bold text-primary ">
				{{$product->name}}
			</h2>
            <h6 class="shadow-sm text-center ms-auto">
            	Collection / {{$product->category->name}} /{{$product->name}}
            </h6>
        </div>


		<div class="card-body">
			<div id="msg">
				@if(isset($success))
				<div class="alert alert-success"></div>
				@endif
			</div>

			<div class="row">
				<div class="col-md-4 border-right">
					<img class="w-75" src="{{asset('asset/uploads/products/'.$product->image)}}">
				</div>

				<div class="col-md-8">
					<div class="row">
						<div class="col">
							<h2 class="mb-0 font-weight-bold text-primary ">
								{{$product->name}}
							</h2>
						</div>
						<div class="col">
							<label class="me-3 fw-bold fs-6 badge bg-secondary p-2 ">Price: {{$product->price}}</label>
							@if($product->size)
							<label class="me-3 fw-bold fs-6 badge bg-secondary p-2 ">Size: {{$product->size}}</label>
							@endif

						</div>
					</div>
				<hr>
				<label class="me-3 fw-bold ">Description:</label>
				<p class="mt-3">
					{!!$product->description!!}
				</p>
				<hr>
				@if($product->policy)
					<label class="me-3 fw-bold ">Policy:</label>
					<p class="mt-3">
						{!!$product->policy!!}
					</p>
					<hr>
				@endif

				<div class="row mt-2">
					<div class="col-md-3">
   						<label for="qty">Quantity</label>
						<div class="input-group text-center mb-3">	
							<input type="hidden" value="{{$product->id}}" class="product_id" name="">

							<button class="input-group-text decrement-btn">-</button>
							<input type="text" name="quantity" class="form-control text-center qty_input"
								@if($product_qty=App\Models\Cart::select('product_qty')->where('user_id',Auth::id())->where('product_id',$product->id)->first())
									value=" {{$product_qty->product_qty}} "
								@else  value="1"
								@endif >
							<button class="input-group-text increment-btn">+</button>
						</div>
					</div>

					<div class="col-md-10">
						@if(App\Models\Cart::where('user_id',Auth::id())->where('product_id',$product->id)->exists())
							<button type="submit" class="update-quantity-btn btn btn-primary">Update quantity</button>
							<button type="submit" class="remove-frome-cart-btn btn btn-danger me-3">🛒 Remove from cart</button>
						@else
							<button type="submit" class="add-to-cart-btn btn btn-primary">Add to Cart</button>
						@endif
				
					</div>
					
				</div>
				</div>
			</div>
		</div>
		
	</div>
</div>



@endsection


@section('script')

<script>
	$(document).ready(function() {
		
		$('.increment-btn').click( function(e) {
			e.preventDefault();

			var inc_value = $('.qty_input').val();
			var value = parseInt(inc_value ,10);
			value = isNaN(value) ? 0 : value;
			if(value < 10){
				value++;
				$('.qty_input').val(value);
			}
		});

		$('.decrement-btn').click( function(e) {
			e.preventDefault();

			var dec_value = $('.qty_input').val();
			var value = parseInt(dec_value ,10);
			value = isNaN(value) ? 0 : value;
			if (value > 1) {
				value-- ;
				$('.qty_input').val(value);
			}
		});

		$('.update-quantity-btn').click(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            var quantity = $(this).closest('.product_data').find('.qty_input').val();
            var product_id = $(this).closest('.product_data').find('.product_id').val();


            $.ajax({
                url: "{{ route('update.quantity') }}",
                method: "GET",
                data: {
                    'quantity': quantity,
					'product_id': product_id,

                },
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message); 
                },
                error: function (xhr) {
                  if (xhr.status == 404) {
                   location.reload();
                  }
                }


            });
        });

		
	});
</script>

@endsection