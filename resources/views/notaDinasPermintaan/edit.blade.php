@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Nota Dinas - Permintaan Rencana Pengadaan Barang/Jasa') }}</b><center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('nota_dinas_permintaan.update', ['ID_Pengadaan'=>$pengadaan->ID_Pengadaan, 'id_nota_dinas_permintaan' => $notaDinasPermintaan->id_nota_dinas_permintaan]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kota">Kota:</label>
                            <select name="kota" id="kota" class="form-control" required>
                                <option value=""> </option>
                                @foreach($kotaOptions as $option)
                                <option value="{{ $option->Kota }}" {{ old('kota', $notaDinasPermintaan->ID_Kota) == $option->ID_Kota ? 'selected' : '' }}>
                                    {{ $option->Kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Tanggal">Tanggal</label>
                            <input type="date" name="Tanggal" id="Tanggal" class="form-control" required value="{{ old('Tanggal', $notaDinasPermintaan->Tanggal) }}">
                        </div>

                        <div class="d-flex justify-content-between">
                            <h3>Nama Pekerjaan: {{ $pengadaan->Judul_Pengadaan }}</h3>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="nomor_nd_ppbj">Nomor ND PPBJ</label>
                            <input type="text" name="nomor_nd_ppbj" id="nomor_nd_ppbj" class="form-control" required value="{{ old('nomor_nd_ppbj', $notaDinasPermintaan->Nomor_ND_PPBJ) }}">
                        </div>

                        <div class="form-group">
                            <label for="ringkasan_pekerjaan">Ringkasan Pekerjaan</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="ringkasan_pekerjaan">{{ old('ringkasan_pekerjaan', $pengadaan->Ringkasan_Pekerjaan) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="divisi">Divisi Pengguna</label>
                            <select name="divisi" id="divisi" class="form-control" required>
                                <option value=""> </option>
                                @foreach($divisiOptions as $option)
                                        <option value="{{ $option->id_divisi }}" data-divisi="{{ $option->id_divisi }}" {{ $notaDinasPermintaan->divisi_pengguna == $option->nama_divisi ? 'selected' : '' }}>
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
                                <option value="{{ $user->name }}" data-divisi="{{ $user->id_divisi }}" {{ $notaDinasPermintaan->nama_pengguna == $user->name ? 'selected' : '' }}>
                                    {{-- <option value="{{ $user->name }}" data-divisi="{{ $user->id_divisi }}"> --}}
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jenis_pengadaan">Jenis Pengadaan</label>
                            <select name="jenis_pengadaan" id="jenis_pengadaan" class="form-control" required>
                                <option value=""> </option>
                                @foreach($jenisPengadaanOptions as $option)
                                <option value="{{ $option->Jenis_Pengadaan }}" {{ old('jenis_pengadaan', $jenisPengadaan) == $option->ID_Jenis_Pengadaan ? 'selected' : '' }}>
                                        {{ $option->Jenis_Pengadaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="informasi_anggaran">Informasi Anggaran / No. PRK</label>
                            <input type="number" step="any" name="informasi_anggaran" id="informasi_anggaran" class="form-control" required value="{{ old('informasi_anggaran', $notaDinasPermintaan->Nomor_PRK) }}">
                        </div>

                        <div class="form-group">
                            <label for="nama_anggaran">Sumber Anggaran:</label>
                            <select name="nama_anggaran" id="nama_anggaran" class="form-control" required>
                                <option value=""> </option>
                                @foreach($sumberAnggaranOptions as $option)
                                <option value="{{ $option->nama_anggaran }}" {{ $sumberAnggaran == $option->ID_Sumber_Anggaran ? 'selected' : '' }}>
                                        {{ $option->nama_anggaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pagu_anggaran">Pagu Anggaran</label>
                            <input type="number" step="any" name="pagu_anggaran" id="pagu_anggaran" class="form-control" required value="{{ old('pagu_anggaran', $notaDinasPermintaan->pagu_anggaran) }}">
                        </div>

                        <div class="form-group">
                            <label for="cost_center">Cost Center</label>
                            <input type="text" name="cost_center" id="cost_center" class="form-control" required value="{{ old('cost_center', $notaDinasPermintaan->cost_center) }}">
                        </div>

                        <div>
                            <label for="rencana_tanggal_terkontrak_mulai">Rencana Tanggal Terkontrak Mulai</label>
                            <span style="margin: 0 130px;"></span>
                            <label for="rencana_tanggal_terkontrak_selesai">Rencana Tanggal Terkontrak Selesai</label>
                        </div>
                        <div class="form-group" style="display: flex; ">
                                <input type="date" name="rencana_tanggal_terkontrak_mulai" id="rencana_tanggal_terkontrak_mulai" class="form-control" style="width: 45%;" value="{{ old('rencana_tanggal_terkontrak_mulai', $pengadaan->rencana_tanggal_terkontrak_mulai) }}">
                                <span style="margin: 0 15px;"><b>-</b></span>
                                <input type="date" name="rencana_tanggal_terkontrak_selesai" id="rencana_tanggal_terkontrak_selesai" class="form-control" style="width: 45%;" value="{{ old('rencana_tanggal_terkontrak_selesai', $pengadaan->rencana_tanggal_terkontrak_selesai) }}">
                        </div>

                        <div class="form-group">
                            <label for="rencana_durasi_kontrak">Rencana Durasi Kontrak</label>
                            <div class="input-group">
                                <input type="number" name="rencana_durasi_kontrak" id="rencana_durasi_kontrak" class="form-control" style="width: 70%;" value="{{ old('rencana_durasi_kontrak', $pengadaan->rencana_durasi_kontrak) }}">
                                <select name="rencana_durasi_kontrak_tanggal" id="rencana_durasi_kontrak_tanggal" class="form-control">
                                    <option value=""> </option>
                                    <option value="Hari Kerja" {{ old('rencana_durasi_kontrak_tanggal', $pengadaan->rencana_durasi_kontrak_tanggal) == 'Hari Kerja' ? 'selected' : '' }}>Hari Kerja</option>
                                    <option value="Hari Kalender" {{ old('rencana_durasi_kontrak_tanggal', $pengadaan->rencana_durasi_kontrak_tanggal) == 'Hari Kalender' ? 'selected' : '' }}>Hari Kalender</option>
                                    <option value="Bulan" {{ old('rencana_durasi_kontrak_tanggal', $pengadaan->rencana_durasi_kontrak_tanggal) == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                                    <option value="Tahun" {{ old('rencana_durasi_kontrak_tanggal', $pengadaan->rencana_durasi_kontrak_tanggal) == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                                </select>
                            </div>
                        </div>

                    <div>
                        @if ($jenisPengadaan != 1)
                        <div class="form-group" id="url_kak">
                            <label for="url_kak">URL KAK</label>
                            <input type="text" name="url_kak" id="url_kak" class="form-control" value="{{ old('url_kak', $notaDinasPermintaan->url_kak) }}" placeholder="Contoh: https://mctn.co.id" pattern="https?://.+">
                            @error('url_kak')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @else
                        <div class="form-group" id="url_spesifikasi_teknis">
                            <label for="url_spesifikasi_teknis">URL Spesifikasi Teknis</label>
                            <input type="text" name="url_spesifikasi_teknis" id="url_spesifikasi_teknis" class="form-control" value="{{ old('url_spesifikasi_teknis', $notaDinasPermintaan->url_spesifikasi_teknis) }}" placeholder="Contoh: https://mctn.co.id" pattern="https?://.+">
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
                            <option value="{{ $option->name }}" {{ old('divisiUser1', $divisiUser1) == $option->name ? 'selected' : '' }}>
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
    document.addEventListener("DOMContentLoaded", function() {
     
        // Ambil elemen select jenis_pengadaan
        const jenisPengadaanSelect = document.getElementById("jenis_pengadaan");
    
        // Ambil elemen formulir URL KAK dan URL Spesifikasi Teknis
        const urlKAK = document.getElementById("url_kak");
        const urlSpesifikasiTeknis = document.getElementById("url_spesifikasi_teknis");
    
        // Tambahkan event listener untuk perubahan pada jenis_pengadaan
        jenisPengadaanSelect.addEventListener("change", function() {
    
            urlKAK.style.display = "none";
            urlSpesifikasiTeknis.style.display = "none";
    
            // Tampilkan elemen yang sesuai dengan jenis_pengadaan
            if (jenisPengadaanSelect.value === "Barang") {
                urlSpesifikasiTeknis.style.display = "block";
            } else if (jenisPengadaanSelect.value === "Jasa Konstruksi" || jenisPengadaanSelect.value === "Jasa Konsultasi" || jenisPengadaanSelect.value === "Jasa Lainnya" || jenisPengadaanSelect.value === "Pengadaan Khusus") {
                urlKAK.style.display = "block";
            }
        });
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

