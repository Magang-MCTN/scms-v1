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
    <script src="{{ asset('storage/vendor.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- Navbar -->
    <div class="carousel slide" data-ride="carousel" style="z-index: 1">
        <div class="container-fluid text-white" id="change-color">
            <!-- Navbar content -->
        </div>
    </div>

    <!-- Profile Section -->
    <div class="container-fluid transparent pt-5 pb-5" id="parallax1"
        style="background-image:url('Images/desktop.jpg');background-size:cover;background-attachment:fixed;">
        <div class="container sift-couple" height="200px">
            <span class="col-xl-5 col-lg-5 col-md-6 col-sm-12 col-12 text-center"
                style="font-weight:700;font-size:20px;">{{ __('PERWAKILAN PESERTA') }}</span>
            <div class="row">
                <div class="col-sm-7">
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
                                </tr>
                                <tr>
                                    <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->name }}</td>
                                    <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->email }}</td>
                                    <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->jabatan }}</td>
                                    <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->no_telepon_perwakilan }}</td>
                                    <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->created_at }}</td>
                                    <td class="col-sm-9 text-secondary">{{ auth()->guard('web_vendor')->user()->signature }}</td>
                                </tr>
                                <!-- Peserta Section -->
                                @if (auth()->guard('web_vendor')->user()->tabelPeserta)
                                    @foreach(auth()->guard('web_vendor')->user()->tabelPeserta as $peserta)
                                        <tr>
                                            <td class="col-sm-9 text-secondary">{{ $peserta->Nama_Peserta }}</td>
                                            <td class="col-sm-9 text-secondary">{{ $peserta->jabatan }}</td>
                                            <td class="col-sm-9 text-secondary">{{ $peserta->Email_Peserta }}</td>
                                            <td class="col-sm-9 text-secondary">{{ $peserta->Nomor_Kontak_Peserta }}</td>
                                            <td class="col-sm-9 text-secondary">{{ $peserta->created_at }}</td>
                                            <td class="col-sm-9 text-secondary">{{ $peserta->signature }}</td>
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
                        {{-- <div class="form-group">
                            <label for="signature">Signature</label>
                            <input type="file" class="form-control" id="signature" name="signature" accept=".png" >
                        </div> --}}
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
        // $("#Nama_Peserta").val("");
        // $("#jabatan").val("");
        // $("#Email_Peserta").val("");
        // $("#Nomor_Kontak_Peserta").val("");
        // $("#signature").val("");
        $("#tambahBtn").text("Tambah");
        $("#formModal").modal("show");
    });

    $("#form").submit(function (event) {
        event.preventDefault();
        // var namaPeserta = $("#Nama_Peserta").val();
        // var jabatan = $("#jabatan").val();
        // var emailPeserta = $("#Email_Peserta").val();
        // var nomorKontakPeserta = $("#Nomor_Kontak_Peserta").val();
        // var signature = $("#signature").val();
        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('profile-vendor.store') }}",
            type: "POST",
            data: formData,
            processData: false,  // Memproses data FormData tanpa mengubahnya
            contentType: false,  // Tidak mengatur tipe konten secara otomatis
            // data: {
            //     _token: "{{ csrf_token() }}",
            //     Nama_Peserta: namaPeserta,
            //     jabatan: jabatan,
            //     Email_Peserta: emailPeserta,
            //     Nomor_Kontak_Peserta: nomorKontakPeserta,
            //     // signature: signature,
            // },
            success: function (response) {
                console.log(response);
                $("#formModal").modal("hide");
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    $("#closeModalBtnForm").click(function () {
        $("#formModal").modal("hide");
    });
});

    </script>
</body>

</html>
