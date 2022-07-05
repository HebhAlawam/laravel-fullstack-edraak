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

    <form method="POST" action="{{ route('login') }}">
        @csrf
    <div class="row g-0 d-flex align-items-center ">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="{{asset('asset/seed/photo/login.jpg')}}" alt="Trendy Pants and Shoes"
          class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
      </div>
      <div class="col-lg-8">
       <h1 class="text-center text-primary" >Login</h1>
       <div class="card-body py-5 px-md-5">
        
          <form>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email address</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>

              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                   <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember"> Remember me </label>
                </div>
              </div>

              
              <div class="col">
                @if (Route::has('password.request'))
                    <a href="#!">Forgot password?</a>
                 @endif

              </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4"><i class="fa fa-sign-in me-2"></i>Login</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</section></div>
<!--End login -->

@include('admin.layouts.footer')
