<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('storage/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/template/css/icon/style.css') }}">
    <script src="{{ asset('storage/vendor.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container-fluid text-white" id="change-color">
        <div class="row" id="top-containt">
            <div class="col-4 text-center">
                <a href="/vendor"><img src="{{ asset ('dashboard/template/images/MCTN.png')}}" height="100px" ></a>
            </div>
            <div class="col-8 pt-4 mt-1 text-center">
                <span class="menu-1"><a href="/vendor" class="color">Beranda</a></span>
                <span class="menu"><a href="ecommerce-price-men.html" class="color">Pengadaan</a></span>
                <span class="menu"><a href="/profile/vendor" class="color">Status</a></span>
                <span class="menu"><a href="/profile/vendor" class="color">Profile</a></span>
                <span class="menu"><a href="/logout/vendor" class="color">Logout</a></span>
                <span class="menu"><a href="login-form.html" class="color" style="color:black">Contact</a></span>
            </div>
        </div>
    </div>

    <div class="container sift-couple" height="200px">
        <span class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12 text-center" style="font-weight:700;font-size:20px;">{{ __('PERWAKILAN PESERTA') }}</span>
        <div class="row">
            <div class="col-sm-16">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <!-- User Profile -->
                            <tr>
                                <th class="col-sm-3">Name</th>
                                <th class="col-sm-3">Email Perwakilan</th>
                                <th class="col-sm-3">Jabatan</th>
                                <th class="col-sm-3">Nomor Telepon Perwakilan</th>
                                <th class="col-sm-3">Tanggal Registrasi</th>
                                <th class="col-sm-3">Tanda Tangan</th>
                                <th class="col-sm-3">Upload Tanda Tangan</th>
                                <th class="col-sm-3">Aksi</th>
                            </tr>
                            <tr>
                                {{-- <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->name }}</td>
                                <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->email }}</td>
                                <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->jabatan }}</td>
                                <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->no_telepon_perwakilan }}</td>
                                <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->created_at }}</td>
                                <td class="col-sm-9 text-secondary">
                                    @if (auth()->guard('web_vendor')->user()->signaturesVendor)
                                        @foreach(auth()->guard('web_vendor')->user()->signaturesVendor as $signature)
                                            <img src="{{ asset('storage/signatures-vendor/' . $signature->signatures) }}" alt="Signature Image" height="50">
                                        @endforeach
                                    @else
                                        Tidak ada tanda tangan.
                                    @endif
                                </td>
                                <td class="col-sm-9 text-secondary">
                                    <form id="form_{{ auth()->guard('web_vendor')->user()->ID_Vendor }}" action="{{ route('profile-vendor.add-signature-vendor', ['ID_Vendor' => auth()->guard('web_vendor')->user()->ID_Vendor]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" class="form-control" name="signatures" accept=".png">
                                        <button type="submit" class="btn btn-secondary">Tambah</button>
                                    </form>
                                </td>
                                <td class="col-sm-9 text-secondary">
                                    <button type="button" class="btn btn-warning edit-button" id="{{ auth()->guard('web_vendor')->user()->ID_Vendor }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                
                                    <div class="modal fade" id="editModal{{auth()->guard('web_vendor')->user()->ID_Vendor}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                                                    <button type="button" class="close closeModalBtnEdit" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="form" action="{{ route('profile-vendor.update', ['ID_Vendor' => auth()->guard('web_vendor')->user()->ID_Vendor]) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="Nama_Peserta">Nama Perwakilan</label>
                                                            <input type="text" class="form-control" id="Nama_Peserta" name="Nama_Peserta" placeholder="Nama Perwakilan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jabatan">Jabatan</label>
                                                            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Email_Peserta">Email Perwakilan</label>
                                                            <input type="text" class="form-control" id="Email_Peserta" name="Email_Peserta" placeholder="Email Perwakilan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Nomor_Kontak_Peserta">Kontak Perwakilan</label>
                                                            <input type="text" class="form-control" id="Nomor_Kontak_Peserta" name="Nomor_Kontak_Peserta" placeholder="Kontak Perwakilan" required>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" form="edit-form-{{auth()->guard('web_vendor')->user()->ID_Vendor}}" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <form id="delete-form-{{ auth()->guard('web_vendor')->user()->ID_Vendor }}" action="{{ route('profile-vendor.delete', auth()->guard('web_vendor')->user()->ID_Vendor) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <a href="#" class="btn btn-danger" onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { event.preventDefault(); document.getElementById('delete-form-{{ auth()->guard('web_vendor')->user()->ID_Vendor }}').submit(); }">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                </td>
                            </tr> --}}
                            <!-- Peserta Section -->
                            @if (auth()->guard('web_vendor')->user()->tabelPeserta)
                                @foreach(auth()->guard('web_vendor')->user()->tabelPeserta as $peserta)
                                    <tr>
                                        <td class="col-sm-9 text-secondary">{{ $peserta->Nama_Peserta }}</td>
                                        <td class="col-sm-9 text-secondary">{{ $peserta->jabatan }}</td>
                                        <td class="col-sm-9 text-secondary">{{ $peserta->Email_Peserta }}</td>
                                        <td class="col-sm-9 text-secondary">{{ $peserta->Nomor_Kontak_Peserta }}</td>
                                        <td class="col-sm-9 text-secondary">{{ $peserta->created_at }}</td>
                                        <td class="col-sm-9 text-secondary">
                                            @if ($peserta->signaturesVendor)
                                                @foreach($peserta->signaturesVendor as $signature)
                                                    <img src="{{ asset('storage/signatures-vendor/' . $signature->signatures) }}" alt="Signature Image" height="50">
                                                @endforeach
                                            @else
                                                Tidak ada tanda tangan.
                                            @endif
                                        </td>
                                        <td class="col-sm-9 text-secondary">
                                            <form id="form_{{ $peserta->ID_Peserta }}" action="{{ route('profile-vendor.add-signature', ['ID_Peserta' => $peserta->ID_Peserta]) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" class="form-control" name="signatures" accept=".png">
                                                <button type="submit" class="btn btn-secondary">Tambah</button>
                                            </form>
                                        </td>
                                        <td class="col-sm-9 text-secondary">
                                            <button type="button" class="btn btn-warning edit-button" id="{{ $peserta->ID_Peserta }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                        
                                            <div class="modal fade" id="editModal{{$peserta->ID_Peserta}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit</h5>
                                                            <button type="button" class="close closeModalBtnEdit" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="form" action="{{ route('profile-vendor-peserta.update', ['ID_Peserta' => $peserta->ID_Peserta]) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="Nama_Peserta">Nama Perwakilan</label>
                                                                    <input type="text" class="form-control" id="Nama_Peserta" name="Nama_Peserta" placeholder="Nama Perwakilan" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jabatan">Jabatan</label>
                                                                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Email_Peserta">Email Perwakilan</label>
                                                                    <input type="text" class="form-control" id="Email_Peserta" name="Email_Peserta" placeholder="Email Perwakilan" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="Nomor_Kontak_Peserta">Kontak Perwakilan</label>
                                                                    <input type="text" class="form-control" id="Nomor_Kontak_Peserta" name="Nomor_Kontak_Peserta" placeholder="Kontak Perwakilan" required>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="edit-form-{{$peserta->ID_Vendor}}" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <form id="delete-form-{{ $peserta->ID_Vendor }}" action="{{ route('profile-vendor-peserta.delete', $peserta->ID_Vendor) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="#" class="btn btn-danger" onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { event.preventDefault(); document.getElementById('delete-form-{{ $peserta->ID_Vendor }}').submit(); }">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <!-- Tidak ada data peserta -->
                                <tr>
                                    <td colspan="6" class="col-sm-9 text-secondary">Tidak ada data peserta.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Tombol Tambah Perwakilan -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('profile-vendor.store') }}">
                        @csrf
                        <button type="button" class="btn btn-primary" id="tambahModalBtn">Tambah Perwakilan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Perwakilan -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Form Pengisian Pekerjaan</h5>
                    <button type="button" class="close" id="closeModalBtnForm" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Move the form inside the modal -->
                    <form id="form" action="{{ route('profile-vendor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="Nama_Peserta">Nama Perwakilan</label>
                            <input type="text" class="form-control" id="Nama_Peserta" name="Nama_Peserta" placeholder="Nama Perwakilan" required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required>
                        </div>
                        <div class="form-group">
                            <label for="Email_Peserta">Email Perwakilan</label>
                            <input type="text" class="form-control" id="Email_Peserta" name="Email_Peserta" placeholder="Email Perwakilan" required>
                        </div>
                        <div class="form-group">
                            <label for="Nomor_Kontak_Peserta">Kontak Perwakilan</label>
                            <input type="text" class="form-control" id="Nomor_Kontak_Peserta" name="Nomor_Kontak_Peserta" placeholder="Kontak Perwakilan" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="tambahBtn">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#tambahModalBtn").click(function () {
                $("#tambahBtn").text("Tambah");
                $("#formModal").modal("show");
            });

            $("#form").submit(function (event) {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('profile-vendor.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        alert('Form berhasil dikirim!');
                        $("#formModal").modal("hide");
                    },
                    error: function (error) {
                        console.log(error);
                        alert('Terjadi kesalahan saat mengirim formulir.');
                    }
                });
            });

            $("#closeModalBtnForm").click(function () {
                $("#formModal").modal("hide");
            });
        });

        function tambahSignatures(ID_Peserta) {
            var formData = new FormData();
            var fileInput = document.getElementById('signatures_' + ID_Peserta);
            formData.append('signatures', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('profile-vendor.add-signature', ['ID_Peserta' => ':ID_Peserta']) }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    // Refresh atau perbarui bagian tabel yang diperlukan
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }

        function tambahSignaturesVendor(ID_Vendor) {
            var formData = new FormData();
            var fileInput = document.getElementById('signatures_' + ID_Vendor);
            formData.append('signatures', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('profile-vendor.add-signature-vendor', ['ID_Vendor' => ':ID_Vendor']) }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    // Refresh atau perbarui bagian tabel yang diperlukan
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    </script>
</body>

</html>
