
@extends('admin.layouts.main')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
  <ol class="breadcrumb mt-2 me-5">
    <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a class="text-dark" href="{{route('product.index')}}">Product</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create</li>
  </ol>
</div>

<div class="row justify-content-center">
 @include('admin.layouts.sidebar')
<div class="col-lg-10">

  <div class="card mb-6">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary p-2">Create Product</h6>
    </div>

    <div class="card-body">
       @if ($msg = Session::get('warning'))
        <div class="alert alert-warning">
          {{$msg}}
        </div>  
      @endif
      <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
      @csrf

        <div class="form-group mb-3"> 
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror "
            placeholder="Enter name of product">
            @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>

        <div class="form-group mb-3">
          <label class="form-label">Image</label>
          <input type="file" class="form-control @error('name') is-invalid @enderror"  name="image">
          @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group mb-3"> 
          <label class="form-label">Description</label>
          <input type="text" name="description" class="form-control @error('description') is-invalid @enderror "
            placeholder="Enter description of product">
            @error('description')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group mb-3"> 
          <label class="form-label">Price</label>
          <input type="number" name="price" class="form-control @error('price') is-invalid @enderror "
            placeholder="Enter price of product">
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
              <input class="form-check-input @error('size') is-invalid @enderror" type="radio" name="size" id="inlineRadio1" value="{{$s}}">
              <label class="form-check-label" for="inlineRadio1">{{$s}}</label>
            </div>
          @endforeach
          @error('size')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

        </div>

        <div class="form-group mb-3"> 
          <label class="form-label">Policy</label>
          <input type="text" name="policy" class="form-control @error('policy') is-invalid @enderror "
            placeholder="Enter policy of product">
            @error('policy')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group mb-3"> 
          <label class="form-label">Category</label>    
          <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
              <option value= '' selected>Select category</option>
              @foreach ($categories as $item)
                  <option  value="{{ $item->id }}">{{ $item->name }}</option>
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
            Pleaze select a category first
          </div >
             @error('category')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
             @enderror
          </div>




        <button type="submit" class="btn btn-primary">Create</button>

      </form>
    </div>

  </div>
</div>
@endsection