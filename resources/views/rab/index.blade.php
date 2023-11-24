@extends('dashboard.app')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Rencana Anggaran Biaya</h4>
        </div>

            <form class="barang-form" method="POST" action="{{ route('rab.store') }}" id="rab-form">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="Kota">Kota:</label>
                        <select name="Kota" id="Kota" class="form-control" required>
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

                <label for="barang">Barang:</label>
                    <div class="form-group">
                        <label for="Kode_Barang">Kode Barang: {{ $newKodeBarang }}</label>
                    </div>

                    <div class="form-group">
                        <label for="Nama_Barang">Nama Barang:</label>
                        <input name="Nama_Barang" id="Nama_Barang" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="Deskripsi">Deskripsi:</label>
                        <textarea name="Deskripsi" id="Deskripsi" class="form-control" required></textarea>
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
                    <input type="number" name="barang[0][estimasi_jumlah]" class="estimasi_jumlah form-control" required>
                </div>

                <div class="form-group">
                    <label for="Harga">Harga:</label>
                    <input type="number" name="barang[0][Harga]" class="Harga form-control" required>
                </div>

                <div class="form-group">
                    <label for="Total">Total (Rp):</label>
                    <input type="number" name="barang[0][Total]" class="Total form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <textarea class=" form-control" name="barang[0][keterangan]"></textarea>
                </div>

    <div id="barang-container">
        <!-- Area untuk menambahkan beberapa barang -->
    </div>
    <div class="form-group">
        <label for="total_keseluruhan">Total Keseluruhan (Rp):</label>
        <input type="number" name="total_keseluruhan" id="total_keseluruhan" class="form-control" disabled>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
<button id="tambahBarangBtn" type="button" class="btn btn-secondary">+ Tambah Barang</button>
    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script type="text/javascript">

    $(document).on("click", "#tambahBarangBtn", function () {
        addNewForm();
    });

    $(document).on("click", ".hapusBarangBtn", function () {
        $(this).closest(".barang-form").remove();
        updateTotalKeseluruhan();
    });

    $(document).on("input", ".estimasi_jumlah, .Harga", function () {
    var form = $(this).closest(".barang-form");
    calculateTotal(form);

});

$("#rab-form").submit(function() {
        updateTotalKeseluruhan();
    });

    function addNewForm() {
    // Dapatkan form terakhir
    var lastForm = $(".barang-form:last");

    // Clone form terakhir
    var newForm = lastForm.clone();

    // Bersihkan nilai input pada form baru
    newForm.find('input, textarea').val('');

    var formCount = $(".barang-form").length + 1;
    newForm.find(".form-group:first label").text("Kode Barang: B" + ("000" + formCount).slice(-4));
    // newForm.find(".kode_barang").text("B" + ("000" + formCount).slice(-4));

    var newFormId = new Date().getTime(); // ID unik berdasarkan timestamp
    newForm.attr('id', 'barang-form-' + newFormId);;

    newForm.find(".hapusBarangBtn").remove();
    newForm.find(".form-group:last").after('<button type="button" class="btn btn-danger hapusBarangBtn">Hapus Barang</button>');

    // Hapus tombol tambah pada form terakhir
    lastForm.find("#tambahBarangBtn").remove();

    // Masukkan form baru setelah form terakhir
    lastForm.after(newForm);

}

function calculateTotal(form) {
    var estimasiJumlah = parseInt(form.find(".estimasi_jumlah").val()) || 0;
    var harga = parseInt(form.find(".Harga").val()) || 0;
    var total = estimasiJumlah * harga;
    form.find(".Total").val(total);

    updateTotalKeseluruhan();
}

function updateTotalKeseluruhan() {
    var totalKeseluruhan = 0;

    // Iterasi melalui setiap form dan tambahkan totalnya
    $(".barang-form").each(function () {
        var totalForm = parseInt($(this).find(".Total").val()) || 0;
        totalKeseluruhan += totalForm;
    });

    // Setel nilai total keseluruhan
    $("#total_keseluruhan").val(totalKeseluruhan);
}

function removeForm(form) {
    form.remove();
    updateTotalKeseluruhan();
}


</script>

@endsection

