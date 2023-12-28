@extends('dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
    <div class="card-header"><center>{{ __('DAFTAR PENGAJUAN BARANG/JASA') }}</center></div>

    <div class="card-body">
        <form method="POST" action="{{ route('pengadaan.store') }}">
            @csrf

    <button type="submit" class="btn btn-primary" id="tambahPekerjaanBtn">Tambah Pekerjaan</button>

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
                    <form id="form" action="{{ route('pengadaan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="Judul_Pengadaan">Nama Pekerjaan</label>
                            <input type="text" class="form-control" id="Judul_Pengadaan" name="Judul_Pengadaan" placeholder="Nama Pekerjaan" required>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="checklist_nota_dinas_permintaan_pengadaan" id="checklist-nota-dinas-permintaan-pengadaan">
                            <label class="form-check-label" for="checklist-nota-dinas-permintaan-pengadaan">Nota Dinas Permintaan Pengadaan</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="checklist_nota_dinas_permintaan_pelaksanaan_pengadaan" id="checklist-nota-dinas-permintaan-pelaksanaan-pengadaan">
                            <label class="form-check-label" for="checklist-nota-dinas-permintaan-pelaksanaan-pengadaan">Nota Dinas Permintaan Pelaksanaan Pengadaan</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="checklist_rencana_anggaran_biaya" id="checklist-rencana-anggaran-biaya">
                            <label class="form-check-label" for="checklist-rencana-anggaran-biaya">Rencana Anggaran Biaya</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="checklist_justifikasi_penunjukan_langsung" id="checklist-justifikasi-penunjukan-langsung">
                            <label class="form-check-label" for="checklist-justifikasi-penunjukan-langsung">Justifikasi Penunjukan Langsung</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="tambahBtn">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive home-tab">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>Nama Pekerjaan</th>
                    <th>Status</th>
                    <th>Operasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Tampilkan data pengadaan sesuai dengan kebutuhan Anda --}}
                @foreach($pengadaan as $item)
                <tr>
                    <td>{{ $item->Judul_Pengadaan }}</td>
                    <td>
                    
                        @php
                        $statusItem = $item->status ?? null;
                        @endphp
                        @if ($statusItem)
                            @if ($statusItem->id_status == 2 || $statusItem->id_status == 15)
                                <span class="badge badge-danger">{{ $statusItem->keterangan_status }}</span>
                                @elseif ($statusItem->id_status == 3|| $statusItem->id_status == 4 || $statusItem->id_status == 5 || $statusItem->id_status == 12)
                                <span class="badge badge-success">{{ $statusItem->keterangan_status }}</span>
                                @else
                                <span class="badge badge-warning">{{ $statusItem->keterangan_status }}</span>
                                @endif 
                        @else
                            Status Tidak Ditemukan
                        @endif
                    </td>
                    {{-- <td>
                        @if($item->status == 'Selesai')
                            <span style="color: green;">&#10003;</span>
                        @else
                            <span style="color: yellow;">&#128308;</span>
                        @endif
                    </td> --}}
                    <td>{{ $item->operasi }}
    
                        <button type="button" class="btn btn-warning edit-button" style="color:white" data-id="{{$item->ID_Pengadaan}}">
                            <i class="fas fa-edit"></i>
                        </button>
    
                        <div class="modal fade" id="editModal{{$item->ID_Pengadaan}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Pengadaan</h5>
                                        <button type="button" class="close closeModalBtnEdit" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="edit-form-{{$item->ID_Pengadaan}}" action="{{ route('pengadaan.update', $item->ID_Pengadaan) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="Judul_Pengadaan">Nama Pekerjaan</label>
                                                <input type="text" class="form-control" name="Judul_Pengadaan" value="{{$item->Judul_Pengadaan}}">
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="checklist_nota_dinas_permintaan_pengadaan" id="checklist-nota-dinas-permintaan-pengadaan-{{$item->ID_Pengadaan}}">
                                                <label class="form-check-label" for="checklist-nota-dinas-permintaan-pengadaan-{{$item->ID_Pengadaan}}">Nota Dinas Permintaan Pengadaan</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="checklist_nota_dinas_permintaan_pelaksanaan_pengadaan" id="checklist-nota-dinas-permintaan-pelaksanaan-pengadaan-{{$item->ID_Pengadaan}}">
                                                <label class="form-check-label" for="checklist-nota-dinas-permintaan-pelaksanaan-pengadaan-{{$item->ID_Pengadaan}}">Nota Dinas Permintaan Pelaksanaan Pengadaan</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="checklist_rencana_anggaran_biaya" id="checklist-rencana-anggaran-biaya-{{$item->ID_Pengadaan}}">
                                                <label class="form-check-label" for="checklist-rencana-anggaran-biaya-{{$item->ID_Pengadaan}}">Rencana Anggaran Biaya</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="checklist_justifikasi_penunjukan_langsung" id="checklist-justifikasi-penunjukan-langsung-{{$item->ID_Pengadaan}}">
                                                <label class="form-check-label" for="checklist-justifikasi-penunjukan-langsung-{{$item->ID_Pengadaan}}">Justifikasi Penunjukan Langsung</label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="edit-form-{{$item->ID_Pengadaan}}" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <form id="delete-form-{{ $item->ID_Pengadaan }}" action="{{ route('pengadaan.delete', $item->ID_Pengadaan) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="btn btn-danger" style="color:white" onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { event.preventDefault(); document.getElementById('delete-form-{{ $item->ID_Pengadaan }}').submit(); }">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('pengadaan.detail', $item->ID_Pengadaan) }}" class="btn btn-primary" style="color:white;">Lihat Detail</a>
                    </td>
                </tr>
            @endforeach
    
            </tbody>
                    </table>
    </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $("#tambahPekerjaanBtn").click(function() {
        // Bersihkan isian modal
        $("#Judul_Pengadaan").val("");
        $("#checklist-nota-dinas-permintaan-pengadaan").prop("checked", false);
        $("#checklist-nota-dinas-permintaan-pelaksanaan-pengadaan").prop("checked", false);
        $("#checklist-rencana-anggaran-biaya").prop("checked", false);
        $("#checklist-justifikasi-penunjukan-langsung").prop("checked", false);

        // Ubah teks tombol "Simpan Perubahan" kembali ke "Tambah"
        $("#tambahBtn").text("Tambah");

        // Tampilkan modal
        $("#formModal").modal("show");
});

$("#form").submit(function(event) {
        event.preventDefault();

        // Mendapatkan nilai checklist
        var checklistNotaDinas = $("#checklist-nota-dinas-permintaan-pengadaan").is(':checked');
        var checklistNotaDinasPelaksanaan = $("#checklist-nota-dinas-permintaan-pelaksanaan-pengadaan").is(':checked');
        var checklistRAB = $("#checklist-rencana-anggaran-biaya").is(':checked');
        var checklistJustifikasi = $("#checklist-justifikasi-penunjukan-langsung").is(':checked');

        // Mendapatkan nilai nama pekerjaan
        var judulPengadaan = $("#Judul_Pengadaan").val();

        // Mengirim data ke server menggunakan AJAX
        $.ajax({
            url: "{{ route('pengadaan.store') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                Judul_Pengadaan: judulPengadaan,
                checklist_nota_dinas_permintaan_pengadaan: checklistNotaDinas,
                checklist_nota_dinas_permintaan_pelaksanaan_pengadaan: checklistNotaDinasPelaksanaan,
                checklist_rencana_anggaran_biaya: checklistRAB,
                checklist_justifikasi_penunjukan_langsung: checklistJustifikasi,
            },
            success: function(response) {
                // Tindakan setelah berhasil
                console.log(response);

                // Menutup modal setelah data berhasil disimpan
                $("#formModal").modal("hide");
            },
            error: function(error) {
                // Tindakan jika terjadi kesalahan
                console.log(error);
            }
        });
    });

    $("#closeModalBtnForm").click(function() {
        $("#formModal").modal("hide");
        });

    $(".edit-button").click(function() {
            var pengadaanID = $(this).data('id');
            var modalID = "#editModal" + pengadaanID;

            // Tampilkan modal edit yang sesuai
            $(modalID).modal("show");

            // Set status checkbox sesuai dengan data dari database
            $("#checklist-nota-dinas-permintaan-pengadaan-" + pengadaanID).prop("checked", {{ $dokumen_checked[$item->ID_Pengadaan]['Nota Dinas Permintaan Pengadaan'] ? 'true' : 'false' }});
            $("#checklist-nota-dinas-permintaan-pelaksanaan-pengadaan-" + pengadaanID).prop("checked", {{ $dokumen_checked[$item->ID_Pengadaan]['Nota Dinas Permintaan Pelaksanaan Pengadaan'] ? 'true' : 'false' }});
            $("#checklist-rencana-anggaran-biaya-" + pengadaanID).prop("checked", {{ $dokumen_checked[$item->ID_Pengadaan]['Rencana Anggaran Biaya'] ? 'true' : 'false' }});
            $("#checklist-justifikasi-penunjukan-langsung-" + pengadaanID).prop("checked", {{ $dokumen_checked[$item->ID_Pengadaan]['Justifikasi Penunjukan Langsung'] ? 'true' : 'false' }});
        });

    $(".closeModalBtnEdit").click(function() {
    // Ini akan menutup modal yang sedang aktif
    $(this).closest(".modal").modal("hide");
    });
});

</script>
    </table>
</div>
</div>
</div>
</div>
</div>
@endsection
