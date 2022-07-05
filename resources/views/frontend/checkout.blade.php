@extends('frontend.layouts.main')

@section('title')
	Checkout
@endsection

@section('content')


<div class="container">
	<div class="card">
		<div class="card-header">
          <h1>Checkout </h1>
    </div>

    <div class="card-body">
      @if ($msg = Session::get('success'))
        <div class="alert alert-info">
          {{$msg}}
        </div>  
    	@endif

		  <div class="row">

		    <div class="col">
		        <form method="post" action="{{ route('checkout.store') }}"> @csrf
			      	<div class="card ">
			      		
			        	<div class="card-header text-primary text-center "> 
			        		<i class="fa fa-map-marker p-2 text-primary"></i>Address
			        	</div>

				        <div class="card-body py-3">
				            <div class="row">
				              <div class="col-md-6">
				                <div class="form-group">
				                  <label for="address1">Address1</label>
				                  <input id="address1" name="address1" type="text" class="form-control @error('address1') is-invalid @enderror " value="@if(isset($user->address1)) {{$user->address1}} @endif">
				                    @error('address1')
						              <span class="invalid-feedback" role="alert">
						                  <strong>{{ $message }}</strong>
						              </span>
						            @enderror
				                </div>
				              </div>
				              <div class="col-md-6">
				                <div class="form-group">
				                  <label for="address1">Address2</label>
				                  <input name="address2" id="address1" type="text" class="form-control" value="@if(isset($user->address2)) {{$user->address2}} @endif" >
				                </div>
				              </div>
				            </div>
				            <!-- /.row-->
				            <div class="row">
				              <div class="col-md-6">
				                <div class="form-group">
				                  <label for="city">City</label>
				                  <input id="city" name="city" type="text" class="form-control @error('city') is-invalid @enderror" value="@if(isset($user->city)) {{$user->city}} @endif">
				                 	@error('city')
						              <span class="invalid-feedback" role="alert">
						                  <strong>{{ $message }}</strong>
						              </span>
						            @enderror
				                </div>
				              </div>
				              <div class="col-md-6">
				                <div class="form-group">
				                  <label for="state">State</label>
				                  <input name="state" id="state" class="form-control" value="@if(isset($user->state)) {{$user->state}} @endif" >
				                </div>
				              </div>
				            </div>
				            <div class="row">
				              <div class="col-md-6">
					              <div class="form-group">
					                <label for="country">Country</label>
					            <select id="country" class="form-control @error('country') is-invalid @enderror" name="country">
									    <option value="">select country</option>
									    <option value="Syria">Syria</option>
									    <option value="Lebanon">Lebanon</option>
									    <option value="Jordan">Jordan</option>
									    <option value="Iraq">Iraq</option>
									</select>
									@error('country')
						              <span class="invalid-feedback" role="alert">
						                  <strong>{{ $message }}</strong>
						              </span>
						            @enderror
					              </div>
					          </div>

				              <div class="col-md-6">
				               <div class="form-group">
				                  <label for="postalCode">Postal Code</label>
				                  <input id="postalCode" name="postalCode" class="form-control @error('postalCode') is-invalid @enderror" value="@if(isset($user->country)) {{$user->postalCode}} @endif">
				                  	@error('postalCode')
								              <span class="invalid-feedback" role="alert">
								                  <strong>{{ $message }}</strong>
								              </span>
								            @enderror
				                </div>
				              </div>
				            </div>
				            <!-- /.row-->
				        </div>
							</div>
		    </div>

					<div class="col">
				    <div class="card mb-3 ">
		      		<div class="card-header text-center text-primary "> 
		      			<i class="fa fa-money p-2 text-primary"></i>Payment Method
		      		</div>

		        	<div class="card-body">

		        		
		              <div class="card m-auto text-center w-50">
		              	<div class="card-body">
			                <h4>Cash on delivery</h4>
			                <p>You pay when you get it.</p>
										</div>
										<div class="card-footer ">
			                <input type="radio" name="payment" value="cash_on_delivery" class="@error('payment') is-invalid @enderror" checked>
			                @error('payment')
						              <span class="invalid-feedback" role="alert">
						                  <strong>{{ $message }}</strong>
						              </span>
						            @enderror
			              </div>
		           		</div>

		            </div>
		          </div>

              
		             
		        </div>
		      </div>

		  </div>
		</div>

		<div class="card-footer">
	          <div class="d-flex justify-content-between">
	          	<a href="{{ route('product.in.cart')}}" class="btn btn-outline-primary"><i class="fa fa-eye p-2"></i>Order review</a>
	            <button type="submit" class="btn btn-primary">Place and order<i class="fa fa-chevron-right p-2"></i></button>
	          </div>
	  </div>
  	</form>

	</div> 
</div>

@endsection
