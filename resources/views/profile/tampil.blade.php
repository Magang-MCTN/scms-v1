@extends('dashboard/app')

@section('content')

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
{{-- <link rel="stylesheet" href="{{ asset('dashboard/template/css/kalender/style.css') }}"> --}}

<div class="d-flex justify-content-center m-5 p-2">
    <div class="mb-3 d-flex justify-content-around">
        {{-- card 1 --}}
            <div class="d-flex justify-content-center mx-5">
              <div class="d-flex flex-column align-items-center text-center mx-5">
                <img src="{{ asset('dashboard/template/images/faces/face1.jpg') }}" alt="Admin" class="rounded-circle" width="150">
                <div class="mt-3">
                  <h4>{{ $users['name'] }}</h4>
                  <p class="text-secondary mb-1">{{ $users['level'] }}</p>
                  <div class="col-sm-12">
                    <a class="btn btn-warning my-2">Edit Profile</a>
                    <a class="btn btn-info">Ganti Profile</a>
                  </div>
                </div>
              </div>
              {{-- end card 1 --}}

              <div class="col-sm-5" id="contentcard">
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Name</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                      {{ $users['name'] }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                      {{ $users['email'] }}
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Level</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                      {{ $users['level'] }}
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Jabatan</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                      {{ $users['jabatan'] }}
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Tanggal Registrasi</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                      {{ $users['created_at'] }}
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-9 text-secondary">
                      <div class="col-md-4">
                          <div class="profile-work">
                              <p>Tanda Tangan</p>
                              @if($signature)
                              <div class="profile-signature">
                                  <img src="{{ asset('storage/signatures/'. $signature->signature) }}" width="100px"  alt="Tanda Tangan {{ $users->name }}">
                              </div>
                              @else
                              <p>Tanda tangan belum tersedia.</p>
                          @endif
                          </div>
                      </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="row">
              </div>
              {{-- kalender --}}
              {{-- <div class="container ml-5">
                <div class="row">
                  <div class="col-md-12">
                    <div class="calendar calendar-first" id="calendar_first">
                      <div class="calendar_header">
                          <button class="switch-month switch-left"> <i class="fa fa-chevron-left"></i></button>
                            <h2></h2>
                          <button class="switch-month switch-right"> <i class="fa fa-chevron-right"></i></button>
                      </div>
                      <div class="calendar_weekdays"></div>
                      <div class="calendar_content"></div>
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
      </div>
      <link rel="stylesheet" href="{{ asset('dashboard\template\css\profile.css') }}">

      {{-- <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mt-5 mb-4">Kalender Hari Ini</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Minggu</th>
                                <th>Senin</th>
                                <th>Selasa</th>
                                <th>Rabu</th>
                                <th>Kamis</th>
                                <th>Jumat</th>
                                <th>Sabtu</th>
                            </tr>
                        </thead>
                        <tbody id="calendarBody">
                            <!-- Tempatkan tanggal di sini menggunakan JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Tambahkan pustaka Bootstrap JavaScript (Popper.js dan Bootstrap JS) -->


    {{--
    <script src="{{ asset('dashboard\template\js\kalender\jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard\template\js\kalender\popper.js') }}"></script>
    <script src="{{ asset('dashboard\template\js\kalender\bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard\template\js\kalender\main.js') }}"></script> --}}


</div>
@endsection
