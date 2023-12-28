@extends('dashboard.app')

@section('content')
<style>
    hr {
        border: 5px solid black;
    }
    form {
    margin-top: 20px;
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}
.btn {
    margin-right: 5px;
}

input,
select {
    margin-bottom: 10px;
}
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2><b>Nama Pekerjaan : {{ $rabData->Judul_Pengadaan }}</b></h2>
            <h4 class="mb-0"><center>Rencana Anggaran Biaya</center></h4>
        </div>
        <form method="POST" action="{{ route('rab.store', ['ID_Pengadaan' => $rabData->ID_Pengadaan]) }}" id="rab-form">
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

                <hr  />

            <div class="card-body">
                <div class="barang-form">
                    <label for="barang">Barang:</label>
                    <div class="form-group">
                        <label for="Kode_Barang">Kode Barang: {{ $newKodeBarang }}</label>
                    </div>

                    <div class="form-group">
                        <label for="Nama_Barang">Nama Barang:</label>
                        <input name="barang[0][Nama_Barang]" id="Nama_Barang" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Deskripsi">Deskripsi:</label>
                        <textarea name="barang[0][Deskripsi]" id="Deskripsi" class=" form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="Unit">Unit:</label>
                        <select name="barang[0][Unit]" id="Unit" class="form-control" required>
                            <option value="Buah">Buah</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Lembar">Lembar</option>
                            <option value="Set">Set</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estimasi_jumlah">Estimasi Jumlah:</label>
                        <input type="number" name="barang[0][estimasi_jumlah]" class="estimasi_jumlah form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Harga">Harga:</label>
                        <input type="number" name="barang[0][Harga]" class="harga form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Total">Total (Rp):</label>
                        <input type="number" name="barang[0][Total]" class="total form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Keterangan">Keterangan:</label>
                        <textarea class=" form-control" name="barang[0][Keterangan]"></textarea>
                    </div>
                </div>

                <div id="barang-container">
                    <br>
                </div>

                <div class="form-group">
                    <label for="total_keseluruhan">Total Keseluruhan (Rp):</label>
                    <input type="number" name="total_keseluruhan" id="total_keseluruhan" class="form-control" readonly>
                </div>

                {{-- <div class="form-group">
                    <label for="divisiUser1">Dikirim Kepada :</label>
                    <select name="divisiUser1" id="divisiUser1" class="form-control" required>
                        <option value=""> </option>
                        @foreach($divisi1Options as $option)
                            <option value="{{ $option->id }}" {{ $divisiUser1 && $option->id == $divisiUser1->id ? 'selected' : '' }}>
                                {{ $option->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

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
                

                {{-- @if ($total_keseluruhan >= 3000000000 && $total_keseluruhan <= 20000000000)
    <div class="form-group" style="display: none;">
        <label for="divisiUser2">Dikirim Kepada (Divisi 2):</label>
        <select name="divisiUser2" id="divisiUser2" class="form-control">
            <option value=""> </option>
            @foreach($divisiUser2Options as $option)
                <option value="{{ $option->id }}" {{ $divisiUser2 && $option->id == $divisiUser2->id ? 'selected' : '' }}>
                    {{ $option->name }}
                </option>
            @endforeach
        </select>
    </div>
@endif

@if ($total_keseluruhan >= 20000000000 && $total_keseluruhan <= 89000000000)
    <div class="form-group" style="display: none;">
        <label for="divisiUser3">Dikirim Kepada (Divisi 3):</label>
        <select name="divisiUser3" id="divisiUser3" class="form-control">
            <option value=""> </option>
            @foreach($divisiUser3Options as $option)
                <option value="{{ $option->id }}" {{ $divisiUser3 && $option->id == $divisiUser3->id ? 'selected' : '' }}>
                    {{ $option->name }}
                </option>
            @endforeach
        </select>
    </div>
@endif --}}

{{-- @if ($total_keseluruhan >= 3000000000 && $total_keseluruhan <= 20000000000)
                    <div class="form-group">
                        <label for="divisiUser2">Dikirim Kepada (Divisi 2):</label>
                        <select name="divisiUser2" id="divisiUser2" class="form-control">
                            <option value=""> </option>
                            @foreach($divisiUser2Options as $option)
                                <option value="{{ $option->id }}" {{ $divisiUser2 && $option->id == $divisiUser2->id ? 'selected' : '' }}>
                                    {{ $option->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                @if ($total_keseluruhan >= 20000000000 && $total_keseluruhan <= 89000000000)
                    <div class="form-group">
                        <label for="divisiUser3">Dikirim Kepada (Divisi 3):</label>
                        <select name="divisiUser3" id="divisiUser3" class="form-control">
                            <option value=""> </option>
                            @foreach($divisiUser3Options as $option)
                                <option value="{{ $option->id }}" {{ $divisiUser3 && $option->id == $divisiUser3->id ? 'selected' : '' }}>
                                    {{ $option->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif --}}

                <button id="tambahBarangBtn" type="button" class="btn btn-secondary">+ Tambah Barang</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}
<script type="text/javascript">
//  $(document).ready(function () {
//                             $('.ckeditor').ckeditor();
//                         });

$(document).ready(function () {
        // Event listener untuk tombol Tambah Barang
        $("#tambahBarangBtn").on("click", function () {
            addNewForm();
        });

        // Event listener untuk tombol Hapus Barang
        $(document).on("click", ".hapusBarangBtn", function () {
            $(this).closest(".barang-form").remove();
            updateTotalKeseluruhan();
        });

        // Event listener untuk input Estimasi Jumlah dan Harga
        $(document).on("input", ".estimasi_jumlah, .harga", function () {
            var form = $(this).closest(".barang-form");
            calculateTotal(form);
        });

        // Event listener untuk form rab-form (submit)
        $("#rab-form").submit(function () {
            updateTotalKeseluruhan();
        });
    });

    function addNewForm() {

        // Dapatkan form terakhir
        var lastForm = $(".barang-form:last");
        var newForm = lastForm.clone();
        newForm.find('input, textarea').val('');

        // Dapatkan kode barang dari form terakhir
        var newKodeBarang = generateRandomKodeBarang();
        newForm.find(".form-group:first label").text("Kode Barang: " + newKodeBarang);
        // Hitung total formulir yang ada
var totalForms = $(".barang-form").length;

newForm.find('[name^="barang"]').each(function () {
    var nameAttr = $(this).attr("name");
    var newNameAttr = nameAttr.replace(/\[\d+\]/, '[' + totalForms + ']');
    $(this).attr("name", newNameAttr);
});

     // Hapus tombol tambah pada form terakhir
     $(".barang-form:last #tambahBarangBtn").remove();

        newForm.find(".hapusBarangBtn").remove();
        newForm.find(".form-group:last").after('<button type="button" class="btn btn-danger hapusBarangBtn">Hapus Barang</button>');

        // Masukkan form baru setelah form terakhir
        lastForm.after(newForm);
    }

    function generateRandomKodeBarang() {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var kodeBarang = 'B';

    for (var i = 0; i < 7; i++) {
        var randomIndex = Math.floor(Math.random() * characters.length);
        kodeBarang += characters.charAt(randomIndex);
    }

    return kodeBarang;
}

    function calculateTotal(form) {
        var estimasiJumlah = parseInt(form.find(".estimasi_jumlah").val()) || 0;
        var harga = parseInt(form.find(".harga").val()) || 0;
        var total = estimasiJumlah * harga;
        form.find(".total").val(total);

        updateTotalKeseluruhan();
    }

    function updateTotalKeseluruhan() {
        var totalKeseluruhan = 0;

        // Iterasi melalui setiap form dan tambahkan totalnya
        $(".barang-form").each(function () {
            var totalForm = parseInt($(this).find(".total").val()) || 0;
            totalKeseluruhan += totalForm;
        });

        // Setel nilai total keseluruhan
        $("#total_keseluruhan").val(totalKeseluruhan);
    }

//     function toggleDivisi2Divisi3Visibility() {
//     var totalKeseluruhan = parseInt($("#total_keseluruhan").val()) || 0;

//     // Ambil elemen-elemen yang berkaitan dengan divisiUser2 dan divisiUser3
//     var divisi2Element = $("#divisiUser2");
//     var divisi3Element = $("#divisiUser3");


//     // Atur visibility berdasarkan kondisi
//     if (totalKeseluruhan >= 3000000000 && totalKeseluruhan <= 20000000000) {
//         divisi2Element.show();
//         divisi3Element.hide();
//     } else if (totalKeseluruhan > 20000000000 && totalKeseluruhan <= 89000000000) {
//         divisi2Element.show();
//         divisi3Element.show();
//     } else {
//         divisi2Element.hide();
//         divisi3Element.hide();
//     }

// }

// // Panggil fungsi saat halaman dimuat dan ketika total keseluruhan berubah
// toggleDivisi2Divisi3Visibility();
//     $("#total_keseluruhan").on("input", toggleDivisi2Divisi3Visibility);

</script>
{{-- <script>
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
    });</script> --}}

@endsection

