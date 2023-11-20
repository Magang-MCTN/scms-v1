<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Page</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset ('dashboard/template/vendors/feather/feather.css')}}">
    <link rel="stylesheet" href="{{ asset ('dashboard/template/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset ('dashboard/template/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset ('dashboard/template/vendors/typicons/typicons.css')}}">
    <link rel="stylesheet" href="{{ asset ('dashboard/template/vendors/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{ asset ('dashboard/template/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset ('dashboard/template/css/vertical-layout-light/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset ('dashboard/template/images/favicon.png')}}" />

    {{-- <style>.password-container {
        position: relative;
    }
    
    #togglePassword {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    </style> --}}
</head>
<body>
    <div class="container-scroller">
        <div class="row justify-content-center">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="m-auto">
                                <div class="card justify-content-center">
                                    <div class="card-body text-left pt-5 px-sm-5">
                                        <div class="brand-logo d-flex justify-content-center ">
                                            <img src="{{ asset ('dashboard/template/images/MCTN.png')}}" alt="logo">
                                        </div>
                                        <h4 class="my-auto p-2 text-center">PT Mandau Cipta Tenaga Nusantara</h3>
                                    </div>
                                    <div class="card-body text-left pb-5 px-4 px-sm-5">
                                        <h4 class="py-2">Join us now</h2>
                                        <form method="POST" action="{{ route('store-vendor') }}">
                                            @csrf
                                            <input id="name" type="text" placeholder="Nama Perwakilan" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus><br>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="jabatan" type="text" placeholder="Jabatan" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan') }}" required autocomplete="jabatan" autofocus><br>
                                            @error('jabatan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="no_telepon_perwakilan" type="text" placeholder="Nomor Telepon Perwakilan" class="form-control @error('no_telepon_perwakilan') is-invalid @enderror" name="no_telepon_perwakilan" value="{{ old('no_telepon_perwakilan') }}" required autocomplete="no_telepon_perwakilan" autofocus><br>
                                            @error('no_telepon_perwakilan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="nama_perusahaan" type="text" placeholder="Nama Perusahaan" class="form-control @error('nama_perusahaan') is-invalid @enderror" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" required autocomplete="nama_perusahaan" autofocus><br>
                                            @error('nama_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="alamat_perusahaan" type="text" placeholder="Alamat Perusahaan" class="form-control @error('alamat_perusahaan') is-invalid @enderror" name="alamat_perusahaan" value="{{ old('alamat_perusahaan') }}" required autocomplete="alamat_perusahaan" autofocus><br>
                                            @error('alamat_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="email_perusahaan" type="text" placeholder="Email Perusahaan" class="form-control @error('email_perusahaan') is-invalid @enderror" name="email_perusahaan" value="{{ old('email_perusahaan') }}" required autocomplete="email_perusahaan" autofocus><br>
                                            @error('email_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="no_telepon_perusahaan" type="text" placeholder="Nomor Telepon Perusahaan Perusahaan" class="form-control @error('no_telepon_perusahaan') is-invalid @enderror" name="no_telepon_perusahaan" value="{{ old('no_telepon_perusahaan') }}" required autocomplete="no_telepon_perusahaan" autofocus><br>
                                            @error('no_telepon_perusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <input id="email" type="email" placeholder="Email Perwakilan" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"><br>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="input-group mb-3">
                                            <input id="password" type="password" placeholder="Password" class="password-container form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <div class="input-group-append">
    
                                                <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                                <span id="mybutton" onclick="change()" class="input-group-text">
                        
                                                    <!-- icon mata bawaan bootstrap  -->
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path fill-rule="evenodd"
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <br>
                                            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="input-group mb-3">
                                            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            <div class="input-group-append">
    
                                                <!-- kita pasang onclick untuk merubah icon buka/tutup mata setiap diklik  -->
                                                <span id="mybutton-confirm" onclick="change()" class="input-group-text">
                        
                                                    <!-- icon mata bawaan bootstrap  -->
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path fill-rule="evenodd"
                                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <br>
                                            <p class="py-2">Already have an account? <a href="/login/vendor">Login here</a></p>
                                            @error('level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="d-flex justify-content-center flex-column my-sm-2">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                                <button type="button" class="btn btn-block btn-microsoft auth-form-btn btn-outline-secondary my-sm-2">
                                                  <i class="ti-microsoft me-2"></i>Connect using Microsoft
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // membuat fungsi change
    function change() {

        // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
        var x = document.getElementById('password').type;
        var y = document.getElementById('password-confirm').type;

        //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
        if (x == 'password') {

            //ubah form input password menjadi text
            document.getElementById('password').type = 'text';
            
            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                            <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                            </svg>`;
        }
        else {

            //ubah form input password menjadi text
            document.getElementById('password').type = 'password';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                            </svg>`;
        }

        if (y == 'password') {

            //ubah form input password menjadi text
            document.getElementById('password-confirm').type = 'text';
            
            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton-confirm').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                            <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                            </svg>`;
        }
        else {

            //ubah form input password menjadi text
            document.getElementById('password-confirm').type = 'password';

            //ubah icon mata terbuka menjadi tertutup
            document.getElementById('mybutton-confirm').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                            </svg>`;
        }
    }
</script>
