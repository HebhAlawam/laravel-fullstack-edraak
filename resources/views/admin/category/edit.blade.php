@extends('admin.layouts.main')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
  <ol class="breadcrumb mt-2 me-5">
    <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a class="text-dark" href="{{route('category.index')}}">Category</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</div>

<div class="row justify-content-center">
 @include('admin.layouts.sidebar')

  <div class="col-lg-10">       	
      <div class="card mb-6">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary p-3">Edit Category</h6>
        </div>
        <div class="card-body">
        	<form method="POST" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data"> 
              	@method('PUT') 
                  @csrf
          <div class="form-group mb-3"> 
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror " 
              value="{{$category->name}}">
              @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          
          </div>
         
          <button type="submit" class="btn btn-primary ">Edit</button>
        </div>
      </div>
    </form>

  </div>
</div>

@endsection