@extends('admin.layouts.main')

@section('content')


  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
    <ol class="breadcrumb mt-2 me-5">
      <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item"><a class="text-dark" href="{{route('subCategory.index')}}">SubCategory</a></li>
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
              <h6 class="m-2 font-weight-bold text-primary">All SubCategories</h6>
              <div class="me-5">
              <a  href="{{route('subCategory.create')}} " class="btn btn-secondary me-2 ">Create</a>
              <a href="{{route('subCategory.trash')}}" class="btn btn-secondary">Trash</a>
              </div>
            </div>

            <div class="card-body">

              @if ($msg = Session::get('success'))
                <div class="alert alert-info">
                  {{$msg}}
                </div>  
              @endif
              

            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th>SN</th>
                    <th>Name</th> 
                    <th>Category</th> 
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if (count($subCategories) > 0)
                  @foreach ($subCategories as $subCategory)
                  
                    <tr>
                      <td>{{ ($subCategories->currentPage()-1) * $subCategories->perPage() + $loop->index + 1 }}</td>
                      <td>{{$subCategory->name}}</td>
                      <td>{{$subCategory->category->name}}</td>
                      <td>
                        <a class="btn btn-primary" href="{{ route('subCategory.edit',$subCategory->id) }}">Edit</a>
                        <a href="{{ route('subCategory.softdelete',$subCategory->id)}}" class="btn btn-warning">Delete</a>   
                      </td>
                    </tr>
                  @endforeach

                  @else
                  <td>No subCategory created yet!</td>
                  @endif
                  
                  
                  
                </tbody>
              </table>
              {!! $subCategories->links() !!}
            </div>

            <div class="card-footer"></div>
          </div>
        </div>
      </div>
          
    </div>
  </div>
</div>
    
@endsection
