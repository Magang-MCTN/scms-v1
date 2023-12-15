@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Nota Dinas - Permintaan Rencana Pengadaan Barang/Jasa') }}</b><center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('nota_dinas_permintaan.store', ['ID_Pengadaan'=>$notaDinasPermintaanID->ID_Pengadaan]) }}">
                        @csrf

                        <div class="form-group">
                            <label for="kota">Kota:</label>
                            <select name="kota" id="kota" class="form-control" required>
                                <option value=""> </option>
                                @foreach($kotaOptions as $option)
                                    <option value="{{ $option->Kota }}" {{ $kota && $option->Kota == $kota->id ? 'selected' : '' }}>
                                        {{ $option->Kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Tanggal">Tanggal</label>
                            <input type="date" name="Tanggal" id="Tanggal" class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h3>Nama Pekerjaan: {{ $notaDinasPermintaanID->Judul_Pengadaan }}</h3>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="nomor_nd_ppbj">Nomor_ND_PPBJ</label>
                            <input type="text" name="nomor_nd_ppbj" id="nomor_nd_ppbj" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="ringkasan_pekerjaan">Ringkasan Pekerjaan</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="divisi">Divisi Pengguna</label>
                            <select name="divisi" id="divisi" class="form-control" required>
                                <option value=""> </option>
                                @foreach($divisiOptions as $option)
                                    <option value="{{ $option->id_divisi }}" data-divisi="{{ $option->id_divisi }}">
                                        {{ $option->nama_divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="divisiUser">Nama Pengguna</label>
                            <select name="divisiUser" id="divisiUser" class="form-control" required>
                                <option value=""> </option>
                                @foreach($divisiUsers as $user)
                                    <option value="{{ $user->name }}" data-divisi="{{ $user->id_divisi }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jenis_pengadaan">Jenis Pengadaan :</label>
                            <br>
                            <label><b>{{ $jenisPengadaan->Jenis_Pengadaan }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="informasi_anggaran">Informasi Anggaran / No. PRK</label>
                            <input type="number" step="any" name="informasi_anggaran" id="informasi_anggaran" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nama_anggaran">Sumber Anggaran:</label>
                            <select name="nama_anggaran" id="nama_anggaran" class="form-control" required>
                                <option value=""> </option>
                                @foreach($sumberAnggaranOptions as $option)
                                    <option value="{{ $option->nama_anggaran }}" {{ $sumberAnggaran && $option->nama_anggaran == $sumberAnggaran->ID_Sumber_Anggaran ? 'selected' : '' }}>
                                        {{ $option->nama_anggaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pagu_anggaran">Pagu Anggaran</label>
                            <input type="number" step="any" name="pagu_anggaran" id="pagu_anggaran" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="cost_center">Cost Center</label>
                            <input type="text" name="cost_center" id="cost_center" class="form-control" required>
                        </div>

                        <div>
                            <label for="rencana_tanggal_terkontrak_mulai">Rencana Tanggal Terkontrak Mulai</label>
                            <span style="margin: 0 130px;"></span>
                            <label for="rencana_tanggal_terkontrak_selesai">Rencana Tanggal Terkontrak Selesai</label>
                        </div>
                        <div class="form-group" style="display: flex; ">
                                <input type="date" name="rencana_tanggal_terkontrak_mulai" id="rencana_tanggal_terkontrak_mulai" class="form-control" style="width: 45%;">
                                <span style="margin: 0 15px;"><b>-</b></span>
                                <input type="date" name="rencana_tanggal_terkontrak_selesai" id="rencana_tanggal_terkontrak_selesai" class="form-control" style="width: 45%;">
                        </div>

                        <div class="form-group">
                            <label for="rencana_durasi_kontrak">Rencana Durasi Kontrak</label>
                            <div class="input-group">
                                <input type="number" name="rencana_durasi_kontrak" id="rencana_durasi_kontrak" class="form-control" style="width: 70%;">
                                <select name="rencana_durasi_kontrak_tanggal" id="rencana_durasi_kontrak_tanggal" class="form-control">
                                    <option value=""> </option>
                                    <option value="Hari Kerja">Hari Kerja</option>
                                    <option value="Hari Kalender">Hari Kalender</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                </select>
                            </div>
                        </div>
                    <div>
                        @if ($jenisPengadaan->ID_Jenis_Pengadaan != 1)
                        <div class="form-group" id="url_kak">
                            <label for="url_kak">URL KAK</label>
                            <input type="text" name="url_kak" id="url_kak" class="form-control" value="{{ old('url_kak') }}" placeholder="Contoh: https://mctn.co.id" pattern="https?://.+">
                            @error('url_kak')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @else
                        <div class="form-group" id="url_spesifikasi_teknis">
                            <label for="url_spesifikasi_teknis">URL Spesifikasi Teknis</label>
                            <input type="text" name="url_spesifikasi_teknis" id="url_spesifikasi_teknis" class="form-control" value="{{ old('url_spesifikasi_teknis') }}" placeholder="Contoh: https://mctn.co.id" pattern="https?://.+">
                            @error('url_spesifikasi_teknis')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="divisiUser1">Dikirim Kepada :</label>
                        <select name="divisiUser1" id="divisiUser1" class="form-control" required>
                            <option value=""> </option>
                            @foreach($divisi1Options as $option)
                                <option value="{{ $option->name }}" {{ $divisiUser1 && $option->name == $divisiUser1 ? 'selected' : '' }}>
                                    {{ $option->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    </body>

                    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.ckeditor').ckeditor();
                        });
                    </script> <script>
CKEDITOR.on("instanceReady", function(event) {
	event.editor.on("beforeCommandExec", function(event) {
		// Show the paste dialog for the paste buttons and right-click paste
		if (event.data.name == "paste") {
			event.editor._.forcePasteDialog = true;
		}
		// Don't show the paste dialog for Ctrl+Shift+V
		if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
			event.cancel();
		}
	})
});</script>

<script>
    document.getElementById("tujuan").addEventListener("change", function () {
        var selectedValue = this.value;
        var judulPengadaan = document.getElementById("judul_pengadaan");
        var perihal = document.getElementById("perihal");

        if (selectedValue === "Rendan") {
            judulPengadaan.value = "Permintaan dokumen rencana pengadaan";
            perihal.value = "Permintaan dokumen rencana pengadaan";
        } else if (selectedValue === "Lakdan") {
            judulPengadaan.value = "Permintaan pelaksanaan pengadaan";
            perihal.value = "Permintaan pelaksanaan pengadaan";
        } else {
            judulPengadaan.value = "";
            perihal.value = "";
        }
    });
</script>
<script>
    document.getElementById('divisi').addEventListener('change', function() {
        var selectedDivisiId = this.value;

        var divisiUserDropdown = document.getElementById('divisiUser');
        var options = divisiUserDropdown.options;

        for (var i = 0; i < options.length; i++) {
            var option = options[i];
            var optionDivisiId = option.getAttribute('data-divisi');

            if (selectedDivisiId === '' || selectedDivisiId == optionDivisiId) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        }
    });
</script>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

