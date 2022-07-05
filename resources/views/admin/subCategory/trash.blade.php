@extends('admin.layouts.main')

@section('content')


  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <a class="fw-bold text-secondary fs-2 ms-3" href="{{ route('dashboard') }}">Dashboard</a>
    <ol class="breadcrumb mt-2 me-5">
      <li class="breadcrumb-item "><a class="text-dark active" href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item"><a class="text-dark" href="{{route('subCategory.index')}}">SubCategory</a></li>
      <li class="breadcrumb-item active" aria-current="page">Trash</li>
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
              <h6 class="m-2 font-weight-bold text-primary">Trashed SubCategories</h6>
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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($subCategories) > 0)
                    @foreach ($subCategories as $key =>  $subCategory)
                    
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$subCategory->name}}</td>
                        <td>
                          <div class="row">
                            <div class="col-6 col-sm-2">
                              <a class="btn btn-primary" href="{{ route('subCategory.back',$subCategory->id) }}">Back</a>
                            </div>

                            <div class="col-6 col-sm-2">
                              <form action="{{route('subCategory.hardDelete',$subCategory->id)}}" method="POST" class="delete_form"> 
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger delete-confirm"> Delete </button>
                              </form>  
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach

                    @else
                    <td>No SubCategory Deleted yet!</td>
                    @endif

                  </tbody>
                </table>
                {!! $subCategories->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    
@endsection
