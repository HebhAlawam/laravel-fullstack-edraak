@extends('frontend.layouts.main')

@section('title')
		Welcome to E-commerce
@endsection

@section('content')
{{--@include('frontend.layouts.slider')--}}

@if (isset($categories))

<div class="py-5">
	<div class="container">
		
		<div class="row">
			<h2>All categories</h2>
			@if ($msg = Session::get('infoCat'))
		        <div class="alert alert-info">
		          {{$msg}}
		        </div>  
		     @endif
			<div class="owl-carousel image-carousel owl-theme">
				@foreach ($categories as $category)
				<div class="item">
					<a class="link-dark" href="{{route('product.filter' ,['cat' => $category->id])}}">
					<div class="card md-4 text-center  " style="height: 350px; ">
						@if($category->name == 'Men')
						<img src="{{asset('asset/img/category/cat-1.jpg')}}" height="75%" width="80">
						@elseif($category->name == 'Women')
						<img src="{{asset('asset/img/category/cat-2.jpg')}}" height="75%" width="80">
						@elseif($category->name == 'Kids')
						<img src="{{asset('asset/img/category/cat-3.jpg')}}" height="75%" width="80">
						@endif
						<div class="card-body">
							<h4> {{$category->name}}</h4>
						</div>
					</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endif

<div class="py-5">
	<div class="container">
		<div class="row">
			<h2>Products</h2>
			
		     
			@forelse ($products as $product)
			<div class="col-md-3 mt-3">
				<div class="card product_data">
					<img class="card-img-top p-3 img-rounded" src="{{asset('asset/uploads/products/'.$product->image)}}">
					<div class="card-body text-center">
						<input type="hidden" value="{{$product->id}}" class="product_id" name="">
						<input type="hidden" value="{{$product->price}}" class="product_price" name="">

						
		                <h4>{{$product->name}}</h4>
		                
						<strong class="float-right font-weight-bold text-muted" >$ {{$product->price}}</strong>

					</div>

					<div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{route('product.detail',['id' => $product->id])}}" class="btn btn-sm text-muted p-0"><i class="fa fa-eye text-primary me-1"></i>View Detail</a>

                        @if(App\Models\Cart::where('user_id',Auth::id())->where('product_id',$product->id)->exists())
	    					<button type="submit" class="remove-frome-cart-btn btn btn-sm text-danger p-0" id="cart{{$product->id}}">
	    						<i class="fa fa-shopping-cart text-danger ms-1"></i> Remove from cart
	    					</button>
						@else
							<button type="submit" class="add-to-cart-btn btn btn-sm text-muted p-0" id="cart{{$product->id}}">
								<i class="fa fa-shopping-cart text-primary me-1"></i> Add to Cart
							</button>   	
                        @endif
    					

                    </div>
				</div>

			</div>

			@empty
			<div class="alert alert-info"> There are no products that match</div>
			@endforelse
		</div>	
	</div>
	
</div>
          {!! $products->links() !!}



@endsection

@section('script')
<script>
	$('.image-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
	    dots:false,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:3 
	        }
	    }
	})
</script>

@endsection


