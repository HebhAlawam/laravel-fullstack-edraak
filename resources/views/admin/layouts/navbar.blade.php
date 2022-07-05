
  
<nav class="navbar navbar-expand-lg navbar-dark bg-primary topbar mb-4 static-top ">
  <div class="container">
    <a class="navbar-brand" href="{{ route('frontend') }}">E-commerce</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="#">{{ (microtime(true) - LARAVEL_START) }}</a>
        </li>
        
      </ul>

      <div class="d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            {{--<img class="img-profile rounded-circle" src="{{asset('adminTemp/img/boy.png')}}" style="max-width: 40px"> --}}
            <a class=" dropdown-toggle ml-2 d-none d-lg-inline text-white small" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user"></i> 
            {{Auth()->user()->name}}
            </a>



            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              
              
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
          </li>
      </ul>
      </div>

    </div>
  </div>
</nav>