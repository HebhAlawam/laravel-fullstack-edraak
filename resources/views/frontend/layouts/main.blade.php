@include('frontend.layouts.header')

        <!-- NavBar -->
@include('frontend.layouts.navbar')
        <!-- Navbar -->


<div class="container-fluid " >

        <!-- Container Fluid-->
     @yield('content')
        <!---Container Fluid-->
</div>

@include('frontend.layouts.footer')


