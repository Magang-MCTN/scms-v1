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
                                        Banyak <br> Barang
                                    </div>
                                    <div class="card-title" style="font-size: 24px">{{$totalScm}}</div>
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
                                        Barang <br> Diajukan</div>
                                    <div class="card-title" style="font-size: 24px">{{$scmDiajukan}}</div>
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
                  <a href="/pengadaan?status=disetujui_pejabat_user" class="text-decoration-none">
                    <div class="card mb-2">
                      <div class="card-body d-flex align-self-center">
                          <div class="row no-gutters align-items-center">
                              <div class="col">
                                  <div class="fw-bold text-black">
                                      Disetujui Pejabat User</div>
                                  <div class="card-title" style="font-size: 24px">{{$scmDisetujui2}}</div>
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
                  <a href="/pengadaan?status=disetujui_pejabat_rendan" class="text-decoration-none">
                    <div class="card mb-2">
                      <div class="card-body d-flex align-self-center">
                          <div class="row no-gutters align-items-center">
                              <div class="col">
                                  <div class="fw-bold text-black">
                                      Disetujui Pejabat Rendan</div>
                                  <div class="card-title" style="font-size: 24px">{{$scmDisetujui1}}</div>
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
                  <a href="/pengadaan?status=disetujui_pejabat_lakdan" class="text-decoration-none">
                    <div class="card mb-2">
                      <div class="card-body d-flex align-self-center">
                          <div class="row no-gutters align-items-center">
                              <div class="col">
                                  <div class="fw-bold text-black">
                                      Disetujui Pejabat Lakdan</div>
                                  <div class="card-title" style="font-size: 24px">{{$scmDisetujui}}</div>
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
                  <a href="/pengadaan?status=ditolak" class="text-decoration-none">
                    <div class="card mb-2">
                      <div class="card-body d-flex align-self-center">
                        <div class="row no-gutters align-items-center">
                          <div class="col">
                            <div class="fw-bold text-black">
                                Barang <br> Ditolak</div>
                            <div class="card-title" style="font-size: 24px">{{$scmDitolak}}</div>
                          </div>
                          <div class="col-auto">
                            <i class="mdi mdi-file-excel" style="color:#097b96"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>

              <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                  <div class="row">
                    <div class="col-lg-8 d-flex flex-column">
                      <div class="row flex-grow">
                        <div class="col-12 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                  <h4 class="card-title card-title-dash">Barang diajukan</h4>
                                 <p class="card-subtitle card-subtitle-dash">Ada {{$totalScm}} barang yang telah diajukan</p>
                                </div>
                                {{-- <div>
                                  <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new member</button>
                                </div> --}}
                              </div>
                              <div class="table-responsive  mt-1">
                                <table class="table select-table">
                                  <thead>
                                    <tr>
                                      <th>
                                        <div class="form-check form-check-flat mt-0">
                                          <label class="form-check-label">
                                        </div>
                                      </th>
                                      <th>User</th>
                                      <th>Nama Pengadaan</th>
                                      <th>Harga</th>
                                      <th>Tanggal</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                   @foreach ($pengadaanScmUser as $item)


                                    <tr>
                                      <td>
                                        <div class="form-check form-check-flat mt-0">
                                          <label class="form-check-label">
                                        </div>
                                      </td>
                                      <td>
                                        <div class="d-flex ">
                                          <img src="/dashboard/template/images/faces/face1.jpg" alt="">
                                          <div>
                                            <h6>{{ $item->nomor_pengadaan }}</h6>
                                            <p>{{ $item->status }}</p>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <h6>{{ $item->nama_barang }}</h6>
                                      </td>
                                      <td>
                                        <div>
                                            <h6>@currency($item->total)</h6>
                                          </div>


                                      </td>
                                      <td><div class="badge badge-opacity-warning">{{ $item->tanggal_pengajuan }}</div></td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                                <ul class="pagination justify-content-start mt-4">
                                  <!-- Tombol "Previous" -->
                                  @if($pengadaanScmUser->previousPageUrl())
                                  <li class="page-item">
                                      <a class="page-link" href="{{ $pengadaanScmUser->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                                  </li>
                                  @else
                                  <!-- Tombol "Previous" dinonaktif pada halaman terakhir -->
                                  <li class="page-item disabled">
                                    <span class="page-link">Previous</span>
                                </li>
                                  @endif

                                  <!-- Halaman-halaman -->
                                  @for($i = 1; $i <= $pengadaanScmUser->lastPage(); $i++)
                                  <li class="page-item {{ ($pengadaanScmUser->currentPage() == $i) ? 'active' : '' }}">
                                      <a class="page-link" href="{{ $pengadaanScmUser->url($i) }}">{{ $i }}</a>
                                  </li>
                                  @endfor

                                  <!-- Tombol "Next" -->
                                  @if($pengadaanScmUser->nextPageUrl())
                                  <li class="page-item">
                                      <a class="page-link" href="{{ $pengadaanScmUser->nextPageUrl() }}">Next</a>
                                  </li>
                                  @else
                                  <!-- Tombol "Next" dinonaktif pada halaman terakhir -->
                                  <li class="page-item disabled">
                                      <span class="page-link">Next</span>
                                  </li>
                                  @endif
                              </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="row flex-grow">
                        <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body card-rounded">
                              <h4 class="card-title  card-title-dash">Recent Events</h4>
                              <div class="list align-items-center border-bottom py-2">
                                <div class="wrapper w-100">
                                  <p class="mb-2 font-weight-medium">
                                    Change in Directors
                                  </p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                      <i class="mdi mdi-calendar text-muted me-1"></i>
                                      <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="list align-items-center border-bottom py-2">
                                <div class="wrapper w-100">
                                  <p class="mb-2 font-weight-medium">
                                    Other Events
                                  </p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                      <i class="mdi mdi-calendar text-muted me-1"></i>
                                      <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="list align-items-center border-bottom py-2">
                                <div class="wrapper w-100">
                                  <p class="mb-2 font-weight-medium">
                                    Quarterly Report
                                  </p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                      <i class="mdi mdi-calendar text-muted me-1"></i>
                                      <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="list align-items-center border-bottom py-2">
                                <div class="wrapper w-100">
                                  <p class="mb-2 font-weight-medium">
                                    Change in Directors
                                  </p>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                      <i class="mdi mdi-calendar text-muted me-1"></i>
                                      <p class="mb-0 text-small text-muted">Mar 14, 2019</p>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="list align-items-center pt-3">
                                <div class="wrapper w-100">
                                  <p class="mb-0">
                                    <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="card-title card-title-dash">Activities</h4>
                                <p class="mb-0">20 finished, 5 remaining</p>
                              </div>
                              <ul class="bullet-line-list">
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                    <p>Just now</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Oliver Noah</span> assign you a task</div>
                                    <p>1h</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Jack William</span> assign you a task</div>
                                    <p>1h</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Leo Lucas</span> assign you a task</div>
                                    <p>1h</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Thomas Henry</span> assign you a task</div>
                                    <p>1h</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                    <p>1h</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Ben Tossell</span> assign you a task</div>
                                    <p>1h</p>
                                  </div>
                                </li>
                              </ul>
                              <div class="list align-items-center pt-3">
                                <div class="wrapper w-100">
                                  <p class="mb-0">
                                    <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> --}}
                    </div>
                    <div class="col-lg-4 d-flex flex-column">
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
                      </div>
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
