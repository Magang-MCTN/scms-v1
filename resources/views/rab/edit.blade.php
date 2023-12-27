@extends('dashboard.app')

@section('content')
<style>
    hr {
        border: 5px solid black;
    }
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2><b>Nama Pekerjaan : {{ $rabData->Judul_Pengadaan }}</b></h2>
            <h4 class="mb-0"><center>Rencana Anggaran Biaya</center></h4>
        </div>
        <form method="POST" action="{{ route('rab.update', ['ID_Pengadaan' => $rabData->ID_Pengadaan, 'ID_RAB' => $rab->ID_RAB]) }}" id="rab-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kota">Kota:</label>
                <select name="kota" id="kota" class="form-control" required>
                    <option value=""> </option>
                    @foreach($kotaOptions as $option)
                        <option value="{{ $option->Kota }}" {{ old('kota', $rab->ID_Kota) == $option->ID_Kota ? 'selected' : '' }}>
                            {{ $option->Kota }}
                        </option>
                    @endforeach
                </select>
            </div>
            

                <div class="form-group">
                    <label for="Tanggal">Tanggal</label>
                    <input type="date" name="Tanggal" id="Tanggal" class="form-control" required value="{{ old('Tanggal', $rab->tanggal) }}">
                </div>

                <hr  />

            <div class="card-body">
                <div class="barang-form">
                    @foreach ($barangData as $index => $barang)
                    <label for="barang">Barang:</label>
                    <div class="form-group">
                        <label for="Kode_Barang">Kode Barang: {{ $newKodeBarang }}</label>
                    </div>
                    <div class="form-group">
                        <label for="Nama_Barang">Nama Barang:</label>
                        <input name="barang[{{ $index }}][Nama_Barang]" id="Nama_Barang" class="form-control" value="{{ $barang->Nama_Barang }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Deskripsi">Deskripsi:</label>
                        <textarea name="barang[{{ $index }}][Deskripsi]" id="Deskripsi" class=" form-control" required>{{ $barang->Deskripsi }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="Unit">Unit:</label>
                        <select name="barang[{{ $index }}][Unit]" id="Unit" class="form-control" value="{{ $barang->Unit }}" required>
                            <option value="Buah">Buah</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Lembar">Lembar</option>
                            <option value="Set">Set</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estimasi_jumlah">Estimasi Jumlah:</label>
                        <input type="number" name="barang[{{ $index }}][estimasi_jumlah]" class="estimasi_jumlah form-control" id="estimasi_jumlah_{{ $index }}" value="{{ $barang->estimasi_jumlah }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Harga">Harga:</label>
                        <input type="number" name="barang[{{ $index }}][Harga]" class="harga form-control" id="harga_{{ $index }}" value="{{ $barang->Harga }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Total">Total (Rp):</label>
                        {{-- <input type="number" name="barang[{{ $index }}][Total]" class="total form-control" value="{{ $barang->Total }}" readonly> --}}
                        <input type="number" name="barang[{{ $index }}][Total]" class="total form-control" id="total_{{ $index }}" value="{{ $barang->Total }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="Keterangan">Keterangan:</label>
                        <textarea class=" form-control" name="barang[{{ $index }}][Keterangan]">{{ $barang->Keterangan }}</textarea>
                    </div>
                    @endforeach
                </div>

                <div id="barang-container">
                    <br>
                </div>

                <div class="form-group">
                    <label for="total_keseluruhan">Total Keseluruhan (Rp):</label>
                    <input type="number" name="total_keseluruhan" class="total_keseluruhan form-control" id="total_keseluruhan_{{ $index }}" value="{{ $rab->total_keseluruhan }}" readonly>
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
                        <option value="{{ $option->name }}" {{ old('divisiUser1', $divisiUser1) == $option->name ? 'selected' : '' }}>
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

                {{-- <button id="tambahBarangBtn" type="button" class="btn btn-secondary">+ Tambah Barang</button> --}}
                <button type="submit" class="btn btn-primary">Update</button>
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
            // calculateTotal2(form2);
        });

        $(document).on("input", "#estimasi_jumlah_{{ $index }}, #harga_{{ $index }}", function () {
            var form2 = $(this).closest(".barang-form");
            // calculateTotal(form);
            calculateTotal2(form2);
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

    function calculateTotal2(form2) {
    var estimasiJumlah2 = parseInt(form2.find("#estimasi_jumlah_{{ $index }}").val()) || 0;
    var harga2 = parseInt(form2.find("#harga_{{ $index }}").val()) || 0;
    var total2 = estimasiJumlah2 * harga2;
    form2.find("#total_{{ $index }}").val(total2);

    updateTotalKeseluruhan();
}


    function updateTotalKeseluruhan() {
        var totalKeseluruhan = 0;

        // Iterasi melalui setiap form dan tambahkan totalnya
        $(".barang-form").each(function () {
        var totalForm1 = parseInt($(this).find(".total").val()) || 0;
        var totalForm2 = parseInt($(this).find("#total_{{ $index }}").val()) || 0;
        totalKeseluruhan += totalForm1 + totalForm2;
        // totalKeseluruhan += totalForm1;
        });

        // Setel nilai total keseluruhan
        $(".total_keseluruhan, #total_keseluruhan_{{ $index }}").val(totalKeseluruhan);
        // $(".total_keseluruhan, #total_keseluruhan_{{ $index }}").val(totalKeseluruhan);
        
    }

    
</script>


@endsection

