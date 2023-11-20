@extends('dashboard/app')

@section('content')
 <!-- partial -->
<link rel="stylesheet" href="{{ asset('dashboard\template\css\cards.css') }}">
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-sm-12">
            <div class="home-tab">
              <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col">
                  <a href="status-pengadaan" class="text-decoration-none">
                    <div class="card mb-2">
                        <div class="card-body d-flex align-self-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="fw-bold text-black">
                                        Total  <br> Kunjungan
                                    </div>
                                    <div class="card-title" style="font-size: 24px">10</div>
                                </div>
                                <div class="col-auto">
                                    <i class="mdi mdi-archive" style="color: #097b96"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                  </a>
              </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col">
                  <a href="/pengadaan?status=diajukan" class="text-decoration-none">
                    <div class="card mb-2">
                      <div class="card-body d-flex align-self-center">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="fw-bold text-black">
                                        Pengajuan <br> Kunjungan</div>
                                    <div class="card-title" style="font-size: 24px">45</div>
                                </div>
                                <div class="col-auto">
                                  <i class="mdi mdi-file-document" style="color: #097b96"></i>
                              </div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col">
                  <a href="/pengadaan?status=disetujui_admin_general" class="text-decoration-none">
                    <div class="card mb-2">
                      <div class="card-body d-flex align-self-center">
                          <div class="row no-gutters align-items-center">
                              <div class="col">
                                  <div class="fw-bold text-black">
                                      Kunjungan disetujui</div>
                                  <div class="card-title" style="font-size: 24px">50</div>
                              </div>
                              <div class="col-auto">
                                <i class="mdi mdi-file-check" style="color: #097b96"></i>
                            </div>
                          </div>
                      </div>
                    </div>
                  </a>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col">
                  <a href="/pengadaan?status=disetujui_admin_general" class="text-decoration-none">
                    <div class="card mb-2">
                      <div class="card-body d-flex align-self-center">
                          <div class="row no-gutters align-items-center">
                              <div class="col">
                                  <div class="fw-bold text-black">
                                      kunjungan ditolak</div>
                                  <div class="card-title" style="font-size: 24px">78</div>
                              </div>
                              <div class="col-auto">
                                <i class="mdi mdi-file-check" style="color: #097b96"></i>
                            </div>
                          </div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="container">
                    <h1>Data Surat 1</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Tamu</th>
                                <th>Asal Perusahaan</th>
                                <th>Periode</th>

                                <th>Status Surat</th>
                                <th>Aksi</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($surat1 as $data)
                                <tr>
                                    <td>{{ $data->nama_tamu }}</td>
                                    <td>{{ $data->asal_perusahaan }}</td>
                                    <td>{{ $data->periode->tanggal_masuk->format('d-m-Y') }} - {{ $data->periode->tanggal_keluar->format('d-m-Y') }}</td>
                                    <td>{{ $data->statusSurat->nama_status_surat }}</td>
                                    <td><a href="#" class="btn btn-info">Lihat</a>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                    </div>
                    {{-- <div class="col-lg-4 d-flex flex-column">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title card-title-dash">Type By Amount</h4>
                              </div>
                              <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                              <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                            </div>
                          </div>
                        </div>
                      </div> --}}
                      {{-- <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title card-title-dash">Todo list</h4>
                                    <div class="add-items d-flex mb-0">
                                      <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                      <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                    </div>
                                  </div>
                                  <div class="list-wrapper">
                                    <ul class="todo-list todo-list-rounded">
                                      <li class="d-block">
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">24 June 2020</div>
                                            <div class="badge badge-opacity-warning me-3">Due tomorrow</div>
                                            <i class="mdi mdi-flag ms-2 flag-color"></i>
                                          </div>
                                        </div>
                                      </li>
                                      <li class="d-block">
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">23 June 2020</div>
                                            <div class="badge badge-opacity-success me-3">Done</div>
                                          </div>
                                        </div>
                                      </li>
                                      <li>
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">24 June 2020</div>
                                            <div class="badge badge-opacity-success me-3">Done</div>
                                          </div>
                                        </div>
                                      </li>
                                      <li class="border-bottom-0">
                                        <div class="form-check w-100">
                                          <label class="form-check-label">
                                            <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                          </label>
                                          <div class="d-flex mt-2">
                                            <div class="ps-4 text-small me-3">24 June 2020</div>
                                            <div class="badge badge-opacity-danger me-3">Expired</div>
                                          </div>
                                        </div>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                      <h4 class="card-title card-title-dash">Leave Report</h4>
                                    </div>
                                    <div>
                                      <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Month Wise </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                          <h6 class="dropdown-header">week Wise</h6>
                                          <a class="dropdown-item" href="#">Year Wise</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="mt-3">
                                    <canvas id="leaveReport"></canvas>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                      <h4 class="card-title card-title-dash">Top Performer</h4>
                                    </div>
                                  </div>
                                  <div class="mt-3">
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face1.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Brandon Washington</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face2.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Wayne Murphy</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face3.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Katherine Butler</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face4.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Matthew Bailey</p>
                                          <small class="text-muted mb-0">162543</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                    <div class="wrapper d-flex align-items-center justify-content-between pt-2">
                                      <div class="d-flex">
                                        <img class="img-sm rounded-10" src="/dashboard/template/images/faces/face5.jpg" alt="profile">
                                        <div class="wrapper ms-3">
                                          <p class="ms-1 mb-1 fw-bold">Rafell John</p>
                                          <small class="text-muted mb-0">Alaska, USA</small>
                                        </div>
                                      </div>
                                      <div class="text-muted text-small">
                                        1h ago
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection

