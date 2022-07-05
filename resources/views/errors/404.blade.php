@extends('frontend.layouts.main')

@section('title')
   Not found
@endsection

@section('content')

<div class="container">
  <div class="row ">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="box text-center shadow py-5 p-4" style="background-color:#f0f0f0">
            <h2 class="text-center text-primary mb-5"> E-commerce </h2>
            <h4>We are sorry - this page is not here anymore</h4>
            <h5 class="text-muted">Error 404 - Page not found</h5>
            <p class="text-center"> {{$exception->getMessage()}}</p>
            <a href="{{route('frontend')}}" class="btn btn-primary text-center"><i class="fa fa-home"></i> Go to Homepage</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
