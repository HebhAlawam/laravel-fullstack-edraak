
@include('admin.layouts.header')

        <!-- NavBar -->
@include('admin.layouts.navbar')
        <!-- Navbar -->


<div class="container-fluid" >
        <!-- Container Fluid-->
     @yield('content')
        <!---Container Fluid-->
</div>

@include('admin.layouts.footer')



