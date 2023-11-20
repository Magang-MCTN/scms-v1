<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Page</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="dashboard/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="dashboard/template/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="dashboard/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="dashboard/template/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="dashboard/template/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="dashboard/template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="dashboard/template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="dashboard/template/images/favicon.png" />
</head>
<form method="POST" action="{{ route('login') }}">
    @csrf
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
         <div class="card col-lg-4 mx-auto">
            <div class="card-body text-left py-5 px-4 px-sm-5">
       <div class="brand-logo d-flex justify-content-center">
               <img src="dashboard/template/images/MCTN.png" alt="logo">

              </div>
              <h5 class="d-flex justify-content-center">PT Mandau Cipta Tenaga Nusantara</h5><br>
              <p class="fw-light">Sign in to continue.</p>
              <form class="pt-3">
                <div class="form-group">
                <input type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
                <div class="form-group">
                  <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                  @enderror
                </div>
                <p>Don't have account? <a href="/register">Register here</a></p>
                <div class="d-flex">
                </div>
                <div class="mt-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                </div>
                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">

                        <!-- tambahkan script di bawah ini untuk membuat tombol signin google -->
                        <a class="btn btn-danger" href="{{ '/auth/redirect'}}">google</a>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="mb-2 d-flex justify-content-center">
                  <button type="button" class="btn btn-block btn-microsoft auth-form-btn">
                    <i class="ti-microsoft me-2"></i>Connect using Microsoft
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="dashboard/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="dashboard/template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="dashboard/template/js/off-canvas.js"></script>
  <script src="dashboard/template/js/hoverable-collapse.js"></script>
  <script src="dashboard/template/js/template.js"></script>
  <script src="dashboard/template/js/settings.js"></script>
  <script src="dashboard/template/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
