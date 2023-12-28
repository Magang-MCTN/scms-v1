@extends('dashboard.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header"><center>{{ __('INFORMASI UMUM RKS') }}</center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rks.store', ['ID_Pengadaan' => $pengadaan->ID_Pengadaan]) }}" enctype="multipart/form-data">
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

                        <div class="form-group">
                            <label for="Nomor_Rks">Nomor RKS</label>
                            <input type="text" name="Nomor_Rks" id="Nomor_Rks" class="form-control" required>
                            @error('Nomor_Rks')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Tanggal_Rks">Tanggal RKS</label>
                            <input type="date" name="Tanggal_Rks" id="Tanggal_Rks" class="form-control" required>
                        </div>

                        <div>
                            <label for="Tanggal_Pengambilan_Rks_Mulai">Tanggal Pengambilan RKS Mulai</label>
                            <span style="margin: 0 140px;"></span>
                            <label for="Tanggal_Pengambilan_Rks_Selesai">Tanggal Pengambilan RKS Selesai</label>
                        </div>
                        <div class="form-group" style="display: flex; ">
                                <input type="date" name="Tanggal_Pengambilan_Rks_Mulai" id="Tanggal_Pengambilan_Rks_Mulai" class="form-control" style="width: 45%;">
                                <span style="margin: 0 15px;"><b>-</b></span>
                                <input type="date" name="Tanggal_Pengambilan_Rks_Selesai" id="Tanggal_Pengambilan_Rks_Selesai" class="form-control" style="width: 45%;">
                        </div>

                        <div>
                            <label for="Waktu_Pengambilan_Rks_Mulai">Waktu Pengambilan RKS Mulai</label>
                            <span style="margin: 0 145px;"></span>
                            <label for="Waktu_Pengambilan_Rks_Selesai">Waktu Pengambilan RKS Selesai</label>
                        </div>
                        <div class="form-group" style="display: flex; ">
                                <input type="date" name="Waktu_Pengambilan_Rks_Mulai" id="Waktu_Pengambilan_Rks_Mulai" class="form-control" style="width: 45%;">
                                <span style="margin: 0 15px;"><b>-</b></span>
                                <input type="date" name="Waktu_Pengambilan_Rks_Selesai" id="Waktu_Pengambilan_Rks_Selesai" class="form-control" style="width: 45%;">
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi Pengambilan RKS:</label>
                            <select name="lokasi" id="lokasi" class="form-control" required>
                                <option value=""> </option>
                                @foreach($kotaOptions as $option)
                                <option value="{{ $option->Kota }}" {{ $kota && $option->Kota == $kota->Kota ? 'selected' : '' }}>
                                    {{ $option->Kota }}
                                </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Status_Rks">Status RKS/Pekerjaan</label>
                                <select name="Status_Rks" id="Status_Rks" class="form-control">
                                    <option value=""> </option>
                                    <option value="Ada di DRP">Ada di DRP</option>
                                    <option value="Tidak Ada di DRP">Tidak Ada di DRP</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="judul_pengadaan">Judul RKS :</label>
                            <br>
                            <label><b>{{ $pengadaan->Judul_Pengadaan }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="sumber_anggaran">Sumber Anggaran :</label>
                            <br>
                            <label><b>{{ $sumberAnggaran->nama_anggaran }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="HPE">Nilai HPE :</label>
                            <br>
                            <label><b>RP.&nbsp;{{ $hpe->HPE }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="ringkasan_pekerjaan">Ringkasan Pekerjaan :</label>
                            <br>
                            <label><b>{{ $pengadaan->Ringkasan_Pekerjaan }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="Nomor_PRK">Informasi Anggaran / No. PRK :</label>
                            <br>
                            <label><b>{{ $notaDinasPermintaan->Nomor_PRK }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="cost_center">Cost Center :</label>
                            <br>
                            <label><b>{{ $notaDinasPermintaan->cost_center }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="pagu_anggaran">Pagu Anggaran :</label>
                            <br>
                            <label><b>RP.&nbsp;{{ $notaDinasPermintaan->pagu_anggaran }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="jenis_pengadaan" name="jenis_pengadaan" id="jenis_pengadaan">Jenis Pengadaan :</label>
                            <br>
                            <label><b>{{ $jenisPengadaan->Jenis_Pengadaan }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="Metode_Pengadaan">Metode Pengadaan :</label>
                            <select name="Metode_Pengadaan" id="Metode_Pengadaan" class="form-control" required>
                                <option value=""> </option>
                                @foreach($metodePengadaanOptions as $option)
                                    <option value="{{ $option->Metode_Pengadaan }}" {{ $metodePengadaan && $option->Metode_Pengadaan == $metodePengadaan->id ? 'selected' : '' }}>
                                        {{ $option->Metode_Pengadaan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Metode_Penawaran">Metode Penawaran :</label>
                            <select name="Metode_Penawaran" id="Metode_Penawaran" class="form-control" required>
                                <option value=""> </option>
                                @foreach($metodePenawaranOptions as $option)
                                    <option value="{{ $option->Metode_Penawaran }}" {{ $metodePenawaran && $option->Metode_Penawaran == $metodePenawaran->id ? 'selected' : '' }}>
                                        {{ $option->Metode_Penawaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jabatan_pengguna" name="jabatan_pengguna" id="jabatan_pengguna">Pengguna Barang / Jasa :</label>
                            <br>
                            <label><b>{{ $notaDinasPermintaan->jabatan_user_1 }}</b></label>
                        </div>

                        <div class="form-group">
                            <label for="Kualifikasi_Pengadaan">Kualifikasi Pengadaan</label>
                                <select name="Kualifikasi_Pengadaan" id="Kualifikasi_Pengadaan" class="form-control">
                                    <option value=""> </option>
                                    <option value="Prakualifikasi">Prakualifikasi</option>
                                    <option value="Pasca Kualifikasi">Pasca Kualifikasi</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="Kualifikasi_CSMS">Kualifikasi CSMS</label>
                                <select name="Kualifikasi_CSMS" id="Kualifikasi_CSMS" class="form-control">
                                    <option value=""> </option>
                                    <option value="Perlu">Perlu</option>
                                    <option value="Tidak Perlu">Tidak Perlu</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="Metode_Evaluasi_Penawaran">Metode Evaluasi Penawaran :</label>
                            <select name="Metode_Evaluasi_Penawaran" id="Metode_Evaluasi_Penawaran" class="form-control" required>
                                <option value=""> </option>
                                @foreach($metodeEvaluasiPenawaranOptions as $option)
                                    <option value="{{ $option->Metode_Evaluasi_Penawaran }}" {{ $metodeEvaluasiPenawaran && $option->Metode_Evaluasi_Penawaran == $metodeEvaluasiPenawaran->id ? 'selected' : '' }}>
                                        {{ $option->Metode_Evaluasi_Penawaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        @if ($rencanaMulaiFormatted && $rencanaSelesaiFormatted)
                        <div>
                            <label for="rencana_tanggal_terkontrak_mulai">Rencana Tanggal Terkontrak Mulai</label>
                            <span style="margin: 0 130px;"></span>
                            <label for="rencana_tanggal_terkontrak_selesai">Rencana Tanggal Terkontrak Selesai</label>
                        </div>
                        <div class="form-group" style="display: flex; align-items: center;" >
                                <label style="width: 45%;"><b>{{ $pengadaan->rencana_tanggal_terkontrak_mulai }}</b></label>
                                <span style="margin: 0 18px;"><b></b></span>
                                <label style="width: 45%;"><b>{{ $pengadaan->rencana_tanggal_terkontrak_selesai }}</b></label>
                        </div>
                        @endif

                        @if ($rencanaMulaiFormatted && $rencanaSelesaiFormatted)
                        <div class="form-group">
                            <label for="rencana_durasi_kontrak">Rencana Durasi Kontrak :</label>
                            <br>
                            <label><b>{{ $pengadaan->rencana_durasi_kontrak }}</b>&nbsp;&nbsp;<label><b>{{ $pengadaan->rencana_durasi_kontrak_tanggal }}</b></label></label>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="Target_Selesai_Rks">Target Selesai RKS</label>
                            <input type="date" name="Target_Selesai_Rks" id="Target_Selesai_Rks" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="Info_Tambahan">Info Tambahan (Jika Ada)</label>
                            <div class="form-group">
                                <textarea class="ckeditor form-control" name="Info_Tambahan"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="klasifikasi_baku">Klasifikasi Baku Lapangan Usaha Indonesia :</label>
                            <select name="klasifikasi_baku" id="klasifikasi_baku" class="form-control" required>
                                <option value=""> </option>
                                @foreach($klasifikasiOptions as $option)
                                    <option value="{{ $option->Nomor_Klasifikasi }}" {{ $klasifikasi && $option->Nomor_Klasifikasi == $klasifikasi->id ? 'selected' : '' }}>
                                        {{ $option->Nomor_Klasifikasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="Kualifikasi_Peserta_Pengadaan">Kualifikasi Peserta Pengadaan</label>
                            <input type="text" name="Kualifikasi_Peserta_Pengadaan" id="Kualifikasi_Peserta_Pengadaan" class="form-control" required>
                        </div>

                        <div class="form-group" id="url_rks">
                            <label for="url_rks">URL RKS</label>
                            <input type="text" name="url_rks" id="url_rks" class="form-control" value="{{ old('url_rks') }}" placeholder="Contoh: https://mctn.co.id" pattern="https?://.+">
                            @error('url_rks')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="divisiUser2">Dikirim Kepada Pejabat Rendan:</label>
                            <select name="divisiUser2" id="divisiUser2" class="form-control" required>
                                <option value=""> </option>
                                @foreach($divisi2Options as $option)
                                    <option value="{{ $option->name }}" {{ $divisiUser2 && $option->name == $divisiUser2 ? 'selected' : '' }}>
                                        {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="divisiUser1">Dikirim Kepada Pejabat User:</label>
                            <select name="divisiUser1" id="divisiUser1" class="form-control" required>
                                <option value=""> </option>
                                @foreach($divisi1Options as $option)
                                    <option value="{{ $option->name }}" {{ $divisiUser1 && $option->name == $divisiUser1 ? 'selected' : '' }}>
                                        {{ $option->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.ckeditor').ckeditor();
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

