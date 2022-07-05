@extends('admin.layouts.main')

@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
  <ol class="breadcrumb mt-2 me-5">
    <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a class="text-dark" href="{{route('product.index')}}">Product</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</div>

<div class="row justify-content-center">
   @include('admin.layouts.sidebar')
  <div class="col-lg-10">



    <div class="card mb-6">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary p-2">Edit Product</h6>
      </div>
      <div class="card-body">
        @if ($msg = Session::get('warning'))
        <div class="alert alert-warning">
          {{$msg}}
        </div>  
         @endif
        <form action="{{route('product.update',$product->id)}}" method="POSt" enctype="multipart/form-data">        @method('PUT') @csrf
          <div class="form-group"> 
            <label for="">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
              value= "{{$product->name}}" >
              @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group"> 
            <label for="">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror "
              placeholder="Enter image of product">
              <img src="{{asset('asset/uploads/products/'.$product->image)}}" width="80">
              @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group"> 
            <label for="">Description</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror "
              value= "{{$product->description}}" >

              @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group"> 
            <label for="">Price</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror "
              value= "{{$product->price}}" >
              @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>


          <div class="form-group mb-3"> 
          <label class="form-label me-3">Size: </label>
          @foreach ($size as $s)
            <div class="form-check form-check-inline">
              <input class="form-check-input @error('size') is-invalid @enderror" type="radio" name="size" id="inlineRadio1" value="{{$s}}" 
               @if($s == $product->size )
                 checked
               @endif
              >
              <label class="form-check-label" for="inlineRadio1">{{$s}}</label>
            </div>
          @endforeach
          @error('size')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

        </div>

          <div class="form-group"> 
            <label for="">Policy</label>
            <input type="text" name="policy" class="form-control @error('policy') is-invalid @enderror "
              value= "{{$product->policy}}" >
              @error('policy')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group mb-3"> 
            <label class="form-label">Category</label>    
            <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                @foreach ($categories as $item)
                    <option  value="{{ $item->id }}" @if($item->id == $category->id) selected @endif >
                      {{ $item->name }}
                    </option>
                @endforeach
            </select>

            @error('category')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror 
          </div>

          <div class="form-group mb-3"> 
            <label class="form-label">SubCategory</label>    
            <div class="form-control" id="subcategory">  
              @foreach ($subCategories as $key => $subcat)
              <div class="form-check"> 
                <input class="form-check-input @error('subcategory') is-invalid @enderror" type="checkbox"  name="subcategory[]" value="{{$subcat->id}}" id="flexCheckChecked{{$key}}" 
                @foreach ($product->subCategories as $selectedSubcat)
                   @if($subcat->id == $selectedSubcat->id )
                     checked
                   @endif
                 @endforeach
                > 
                <label class="form-check-label" for="flexCheckChecked{{$key}}"> 
                  {{$subcat->name}}
                </label>  
              </div> 
              @endforeach 
            </div >
            @error('subcategory')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection