<!DOCTYPE html>
<html lang="en">
    @include('dashboard/head')

<body>
    @include('dashboard/topbar')
  <div class="container-scroller">


    @include('dashboard/sidebar')
      <!-- partial -->
      @yield('content')
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
@include('dashboard/footer')
<!-- container-scroller -->

<!-- plugins:js -->
{{-- javascript --}}
@include('dashboard/js')

</body>

</html>

