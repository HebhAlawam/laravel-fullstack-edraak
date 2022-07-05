@extends('admin.layouts.main')

@section('content')


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
      <ol class="breadcrumb">
        <li class="breadcrumb-item me-5"><a class="text-dark" href="{{route('dashboard')}}">Home</a></li>
      </ol>
    </div>

    <div class="row justify-content-center ">
      
      <div class="card border-primary text-center" style="max-width: 50%;">
        <div class="card-header">
          <h3>Welcome to dashboard</h3>
        </div>
        <div class="card-body">

          <div class="card">

            <div class="card-header">
              <h6 class="p-2 m-0 font-weight-bold text-primary">Controller List</h6>
            </div>

            <div class="card-body">
              <ul class="nav nav-pills">
                <a href="{{ route('category.index') }}" class="list-group-item list-group-item-action 
                {{str_contains(Request::url(), 'admin/category') ? 'active' : ''}}
                 ">Category</a>
                <a href="{{ route('subCategory.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/subCategory') ? 'active' : ''}}
                ">SubCategory</a>
                <a href="{{ route('product.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/product') ? 'active' : ''}}
                ">Products</a>
                <a href="{{ route('order.index') }}" class="list-group-item list-group-item-action
                {{str_contains(Request::url(), 'admin/order') ? 'active' : ''}}
                ">Orders</a>
              </ul>
            </div>

          </div>

        </div>
      </div>
      
    </div>

@endsection
