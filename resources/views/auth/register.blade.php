@include('admin.layouts.header')

<!-- Start login-->
<section class=" text-center text-lg-start vh-100">
  <style>
    .rounded-t-5 {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    @media (min-width: 992px) {
      .rounded-tr-lg-0 {
        border-top-right-radius: 0;
      }

      .rounded-bl-lg-5 {
        border-bottom-left-radius: 0.5rem;
      }
      body {
        height: 100%
      }
    }
  </style>
  <div class="container py-5 h-100" >
  <div class="card">

    <form method="POST" action="{{ route('register') }}">
      @csrf
    <div class="row g-0 d-flex align-items-center ">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="{{asset('asset/seed/photo/login.jpg')}}" alt="Trendy Pants and Shoes"
          class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
       <div class="card-body py-2 px-md-5">
       <h1 class="text-center text-primary" >Register</h1>
                
          <form>
            <!-- name input -->
          <div class="form-outline mb-4">
            <div class="row">

              <div class="col">
                <label for="name">First name</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="col">
                <label for="lastname">Last name</label>
                <input id="lastname" type="text" class="form-control @error('name') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="name" autofocus>
                @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
         </div>  

            <!-- email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email address</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>

              <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-outline mb-4">
              <label for="password-confirm" class="form-label"> Confirm password</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>


            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4"><i class="fa fa-user-md me-2"></i>Register</button>
          </form>
          <p class="text-center">Already our customer? <a href="{{route('login')}}">Login</a></p>
        </div>
      </div>
    </div>
  </div>
</section></div>
<!--End login -->

@include('admin.layouts.footer')
