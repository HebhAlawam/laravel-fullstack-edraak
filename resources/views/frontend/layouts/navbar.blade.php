
  <!-- Login form -->

<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Customer login</h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('login') }}" method="post"> @csrf
        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" aria-label="email" aria-describedby="basic-addon1">
            @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>

        <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
          <p class="text-center">
            <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
          </p>
        </form>
        <p class="text-center text-muted">Not registered yet?</p>
        <p class="text-center text-sm-muted"><a href="{{ route('register') }}"><strong>Register now!</strong></a> It is easy and done in 1 minute and gives you access to special discounts and much more!</p>
      </div>
    </div>
  </div>
</div>
  <!-- End login form -->


<!-- Topbar Start -->
<div class="sticky-top">
  <div class="container-fluid ">
    <div class="row  py-2 px-xl-5" style="background-color: #7c7878"> 
      <div class="col">
          <div class="d-inline-flex align-items-center">
              <a class="text-white" href="">FAQs</a>
              <span class="text-muted px-2">|</span>
              <a class="text-white" href="">Help</a>
              <span class="text-muted px-2">|</span>
              <a class="text-white" href="">Support</a>
          </div>
      </div>  

      <div class="col-8 text-center">
          <div class="d-inline-flex align-items-center">
              <a class="text-white px-2" href="">
                  <i class="fa fa-facebook-f"></i>
              </a>
              <a class="text-white px-2" href="">
                  <i class="fa fa-twitter"></i>
              </a>
             
              <a class="text-white px-2" href="">
                  <i class="fa fa-instagram"></i>
              </a>
              <a class="text-white pl-2" href="">
                  <i class="fa fa-youtube"></i>
              </a>

      
          </div>
      </div>

      <div class="col-md-2" >
        <ul class="mb-0 list-inline">
            @guest
              @if (Route::has('login'))
                <li class="list-inline-item">
                  <a href="#" class="text-white" data-toggle="modal" data-target="#login-modal">Login |</a>
                </li>
              @endif

              @if (Route::has('register'))
                  <li class="list-inline-item">
                      <a class="text-white" href="{{ route('register') }}">Register </a>
                  </li>
              @endif
              @else
                  <li class="list-inline-item dropdown ">
                      <a id="navbarDropdown" class="text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <i class="fa fa-user ms-2"></i> {{ Auth::user()->name }}
                      </a>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>
                          <a class="dropdown-item" href="{{ route('customer.order') }}">
                              Your order
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
        </ul>
      </div>
    </div>
  </div>

  <!-- Topbar End -->


  <!-- Namvbar Start -->
  <nav class="navbar navbar-expand-lg navbar-light  mb-4" style="background-color:#edf1ff">
    <div class="container ">
      <a class="navbar-brand text-primary fs-4" href="{{route('frontend')}}">E-commerce</a>
      <span class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">{{ (microtime(true) - LARAVEL_START) }}</span>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <div id="search-not-mobile" class="navbar-collapse collapse"></div>

          <a data-toggle="collapse" href="#search" class="btn navbar-btn btn-outline-primary  me-2 d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>

          <div  class="navbar-collapse collapse d-none d-lg-block">
            <a href="{{route('product.in.cart')}}" class="btn btn-outline-primary"> <i class="fa fa-shopping-cart  me-1"></i> <span id="itemInCart"> 
              @if (Auth::check())
               {{App\Models\Cart::where('user_id',Auth::id())->count()}}
              @else
              0
              @endif
            </span> </a>
          </div>  
        </ul>
        
      </div>
    </div>
  </nav>

  <div id="search" class="collapse">
  <div class="container">
    <div class="row  mb-4">
      <div class=" mt-3 col-lg-6">
        <form role="search" class="ml-auto" method="POST" action="{{route('frontend.filter')}}">@csrf
          <div class="input-group">
            <input type="text" placeholder="Search" class="form-control" name="search">
            <div class="input-group-append">
              <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </form>
       </div>


      <div class="col-md-3 mt-3 ms-auto">
         <a href="{{route('advance.filter')}}" class="btn btn-outline-primary">Advance filter<i class="fa fa-chevron-right ms-2"></i></a>
      </div>

    </div>
  </div>
  </div>
   <div id="msg" class="container w-25 me-0">
         
      </div>
</div>
<!-- Namvbar end -->
