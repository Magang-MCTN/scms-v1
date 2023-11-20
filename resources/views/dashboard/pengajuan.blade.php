@extends('dashboard.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">{{ __('Form Pengajuan Barang') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('barang') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_pengadaan">Nomor Pengadaan</label>
                            <input type="text" name="nomor_pengadaan" id="nomor_pengadaan" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" required>
                        </div>
                        <div class="form-group">
                        <label for="dokumen">Silahkan Input Dokumen Pengajuan</label>
                        <div id="toolbar-container"></div>
                        <div id="dokumen" name="dokumen" id="dokumen">



                                <div class="form-group">
                                    <textarea class="ckeditor form-control" name="dokumen"></textarea>
                                </div>
                            </form>
                        </div>
                    </body>
                    <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
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
                        <div>
                        <label for="admintim">Pilih Admin Tim Tujuan:</label>
                        <select id="admintim" name="admintim">
                            @foreach($adminTimList as $adminTimId => $adminTimjabatan)
                                <option value="{{ $adminTimId }}">{{ $adminTimjabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

