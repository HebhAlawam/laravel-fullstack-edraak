@extends('admin.layouts.main')
 
@section('content')



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
      <ol class="breadcrumb mt-2 me-5">
        <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a class="text-dark" href="{{route('category.index')}}">Category</a></li>
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
                <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
                <div class="me-5">
                  <a  href="{{route('category.create')}} " class="btn btn-secondary me-2 ">Create</a>
                </div>
              </div>

              <div class="card-body">

              @if ($msg = Session::get('success'))
                <div class="alert alert-success">
                  {{$msg}}
                </div>  
              @endif
              @if ($msg = Session::get('warning'))
                <div class="alert alert-warning">
                  {{$msg}}
                </div>  
              @endif

              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th>SN</th>
                      <th>Name</th>
                      <th>SubCategories</th>                                     
                      <th>Action</th>
                    </tr>
                  </thead> 
                  <tbody>
                    @if (count($categories) > 0)
                    @foreach ($categories as $category)
                    
                      <tr>
                        <td>{{ ($categories->currentPage()-1) * $categories->perPage() + $loop->index + 1 }}</td>
                        <td>{{$category->name}}</td>

                        <td>
                          @foreach ($category->subcategories as $subCategort)
                          <span class="badge bg-info text-dark"> {{$subCategort->name}} </span>
                          @endforeach
                        </td>
                        <td>
                        <div class="container">
                          <div class="row">
                            <div class="col-6 col-sm-4">
                              <a class="btn btn-primary" href="{{ route('category.edit',$category->id) }}">Edit</a>
                            </div>
                            <div class="col-6 col-sm-4">
                              <form action="{{route('category.destroy',$category->id)}}" method="POST" class="delete_form"> 
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-confirm"> Delete </button>
                              </form>

                            </div>
                          </div>
                        </div>

                        </td>
                      </tr>
                    @endforeach

                    @else
                    <td>No category created yet!</td>
                    @endif
                  </tbody>
                </table>
                {!! $categories->links() !!}
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
    
@endsection
