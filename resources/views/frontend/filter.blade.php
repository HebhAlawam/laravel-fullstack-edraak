@extends('frontend.layouts.main')


@section('content')

<div class="container">
   <form action="{{route('frontend.filter')}}" method="POST"> @csrf


<div class="card h-100"  >	
	<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h3 class="m-0 font-weight-bold text-primary">Advance Filter</h3>
		<button class="btn btn-outline-success " type="submit">Search</button>
	</div>
	<div class="card-body">
	<div class="row">

		<aside class="col-sm-3">
			<div class="card h-100 ">
				<header class="card-header">
					<h6 class="fs-6 text-primary">Category </h6>
				</header>
				<div class="card-body">
					@foreach($categories as $key => $cat)
					<label class="form-check">
					  <input class="form-check-input" type="checkbox" value="{{$key}}" name="category[]" >
					  <span class="form-check-label">
					    {{$cat}}
					  </span>
					</label> <!-- form-check.// -->
					@endforeach
				</div> <!-- card-body.// -->		
			</div> <!-- card.// -->
		</aside> <!-- col.// -->

		<aside class="col-sm-3">
			<div class="card h-100">
				<header class="card-header">
					<h6 class="fs-6 text-primary">SubCategory </h6>
				</header>
				<div class="card-body">
					@foreach($subCategories as $key => $subcat)
					<label class="form-check">
					  <input class="form-check-input" type="checkbox" name="subcategory[]" value="{{$subcat->name}}">
					  <span class="form-check-label">
					    {{$subcat->name}}
					  </span>
					</label>
					@endforeach
				</div> 
			</div> <!-- card.// -->
		</aside> <!-- col.// -->

		<aside class="col-sm-3">
			<div class="card h-100">
				<header class="card-header">
					<h6 class="fs-6 text-primary">Range price </h6>
				</header>
				<div class="card-body">
					<div class="form-row">
						<div class="form-group col-md-6">
						  <label>Min</label>
						  <input type="number" class="form-control" id="inputEmail4" name="min" placeholder="$0">
						</div>
						<div class="form-group col-md-6 text-right">
						  <label>Max</label>
						  <input type="number" class="form-control" placeholder="Max" name="max">
						</div>
					</div>
				 <!-- card-body.// -->
				</div>
			</div> <!-- card.// -->
		</aside> <!-- col.// -->

		<aside class="col-sm-3">
			<div class="card h-100 ">
				<header class="card-header">
					<h6 class="fs-6 text-primary">Size </h6>
				</header>
				<div class="card-body">
				@for($i=0 ; $i< count($sizes); $i++)
					<label class="form-check">
					  <input class="form-check-input" type="checkbox" name="size[]" value="{{ $sizes[$i] }}">
					  <span class="form-check-label">{{ $sizes[$i] }}</span>
					</label>
				@endfor
				</div> <!-- card-body.// -->
			</div> <!-- card.// -->
		</aside> <!-- col.// -->

	</div> <!-- row.// -->
</div>
</div>

</form>
</div> 
<!--container end.//-->

@endsection