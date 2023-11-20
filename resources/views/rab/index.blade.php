@extends('dashboard.app')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Rencana Anggaran Biaya</h4>
        </div>
        <div class="card-body">
            <form class="barang-form" method="POST" action="{{ route('rab.store') }}">
                @csrf
                <label for="barang">Barang:</label>
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang: {{ $newKodeBarang }}</label>
                    </div>

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
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi:</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="unit">Unit:</label>
                    <select name="unit" id="unit" class="form-control" required>
                        <option value="Buah">Buah</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Lembar">Lembar</option>
                        <option value="Set">Set</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="estimasi_jumlah">Estimasi Jumlah:</label>
                    <input type="number" name="estimasi_jumlah[]" class="estimasi_jumlah form-control" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" name="harga[]" class="harga form-control" required>
                </div>

                <div class="form-group">
                    <label for="total">Total (Rp):</label>
                    <input type="number" name="total[]" class="total form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class="ckeditor form-control" name="keterangan"></textarea>
                </div>

    <div id="barang-container">
        <!-- Area untuk menambahkan beberapa barang -->
    </div>
            </form>
            <!-- Total Keseluruhan -->
<div class="form-group">
    <label for="total-keseluruhan">Total Keseluruhan (Rp):</label>
    <input type="number" id="total-keseluruhan" class="form-control" disabled>
</div>
<button id="tambahBarangBtn" type="button" class="btn btn-secondary">+ Tambah Barang</button>
    <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });

    $(document).on("click", "#tambahBarangBtn", function () {
        addNewForm();
    });

    $(document).on("click", ".hapusBarangBtn", function () {
        $(this).closest(".barang-form").remove();
    });

    $(document).on("input", ".estimasi_jumlah, .harga", function () {
    var form = $(this).closest(".barang-form");
    calculateTotal(form);
});


    function addNewForm() {
    // Dapatkan form terakhir
    var lastForm = $(".barang-form:last");

    // Clone form terakhir
    var newForm = lastForm.clone();

    // Bersihkan nilai input pada form baru
    newForm.find('input, textarea').val('');

    var formCount = $(".barang-form").length + 1;
    newForm.find(".kode_barang").text("B" + ("000" + formCount).slice(-4));

    var newFormId = new Date().getTime(); // ID unik berdasarkan timestamp
    newForm.attr('id', 'barang-form-' + newFormId);

    newForm.find(".hapusBarangBtn").remove();
    newForm.find(".form-group:last").after('<button type="button" class="btn btn-danger hapusBarangBtn">Hapus Barang</button>');

    // Hapus tombol tambah pada form terakhir
    lastForm.find("#tambahBarangBtn").remove();

    // Masukkan form baru setelah form terakhir
    lastForm.after(newForm);

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
    $("#total-keseluruhan").val(totalKeseluruhan);
}

function removeForm(form) {
    form.remove();
    updateTotalKeseluruhan();
}


</script>

@endsection

