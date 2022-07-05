@extends('admin.layouts.main')

@section('content')


<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
  <ol class="breadcrumb mt-2 me-5">
    <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a class="text-dark" href="{{route('product.index')}}">Product</a></li>
    <li class="breadcrumb-item active" aria-current="page">View</li>
  </ol>
</div>

<div class="row justify-content-center">
 @include('admin.layouts.sidebar')

<div class="col-md-10">
<div class="row">
  <div class="col-lg-12 mb-4">
    <!-- Simple Tables -->
    <div class="card">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
        <div class="me-5">
            <a  href="{{route('product.create')}} " class="btn btn-secondary me-2 ">Create</a>
            <a href="{{route('product.trash')}}" class="btn btn-secondary">Trash</a>
        </div>
      </div>

      <div class="card-body">
      @if ($msg = Session::get('success'))
        <div class="alert alert-success">
          {{$msg}}
        </div>  
      @endif
      @if ($msg = Session::get('danger'))
        <div class="alert alert-danger">
          {{$msg}}
        </div>  
      @endif
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>SN</th>
                <th>Image</th>                     
                <th>Name</th>  
                <th>Price</th>                     
                <th colspan="3" >Action</th> 
              </tr>
            </thead>
            <tbody>
              @if (count($products) > 0)
              @foreach ($products as $key =>  $product)
              
                <tr>
                  <td>{{ ($products->currentPage()-1) * $products->perPage() + $loop->index + 1 }}</td>
                  <td><img src="{{asset('asset/uploads/products/'.$product->image)}}" width="80"></td>
                  <td>{{$product->name}}</td>                          
                  <td>{{$product->price}}</td>
                  <td>
                    <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">Edit</a>
                  </td>
                  <td>
                    <a class="btn btn-success" href="{{ route('product.show',$product->id) }}">Show</a>
                    </td><td>


                      <form action="{{route('product.softdelete',$product->id)}}" method="POST" class="delete_form"> 
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger delete-confirm"> Delete </button>
                  </td>
                </tr>
              @endforeach

              @else
              <td>No product created yet!</td>
              @endif

            </tbody>
          </table>
          {!! $products->links() !!}
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
         
    
@endsection
