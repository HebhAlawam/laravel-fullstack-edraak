@extends('admin.layouts.main')

@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
  <ol class="breadcrumb mt-2 me-5">
    <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Product</a></li>
    <li class="breadcrumb-item"><a class="text-dark" href="{{route('product.index')}}">{{$product->category->name}} </a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
  </ol>
</div>

<div class="row justify-content-center">
 @include('admin.layouts.sidebar')

 <div class="col-md-8 ">
<div class="row">
    <div class="col-lg-12 mb-4">
  
        <div class="card ">
             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h2 class="mb-0 font-weight-bold text-primary ">
                    {{$product->name}}
                </h2>
                <div class="ms-auto">
                <label class=" fw-bold fs-6 badge bg-secondary p-2 ">Price: {{$product->price}}</label>
                @if($product->size)
                <label class=" fw-bold fs-6 badge bg-secondary p-2 ">Size: {{$product->size}}</label>
                @endif
            </div>

            </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img class="w-50" src="{{asset('asset/uploads/products/'.$product->image)}}">
                </div>

                <div class="col-md-8">

                <label class="me-3 fw-bold fs-5">Description:</label>
                <p class="mt-3">
                    {!!$product->description!!}
                </p>
                <hr>
                @if($product->policy)
                    <label class="me-3 fw-bold fs-5 ">Policy:</label>
                    <p class="mt-3">
                        {!!$product->policy!!}
                    </p>
                    <hr>
                @endif

                <label class="me-3 fw-bold fs-5">SubCategory:</label>
                    @foreach($product->subCategories as $subcat)
                        <span class="badge bg-info text-dark">{{$subcat->name}} </span>
                    @endforeach

                </div>
            </div>
        </div>

        </div> 
	</div>
</div>

@endsection