@extends('dashboard/app')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/decoupled-document/ckeditor.js"></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
                <div class="card-header">{{ __('Form Pengajuan Barang') }}</div>

                <div class="card-body">
                    <form action="{{ route('ajukanUlang', $pengajuan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" id="nama_barang"value="{{ $pengajuan->nama_barang }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_pengadaan">Nomor Pengadaan</label>
                            <input type="text" name="nomor_pengadaan" id="nomor_pengadaan" value="{{ $pengajuan->nomor_pengadaan }}"class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" value="{{ $pengajuan->jumlah }}" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" name="harga" id="harga"value="{{ $pengajuan->harga }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                        <label for="dokumen">Silahkan Input Dokumen Pengajuan</label>
                        <div id="toolbar-container"></div>
                        <div id="dokumen" name="dokumen" id="dokumen">

                        </div>

                        <script>
                            DecoupledEditor
                                .create( document.querySelector( '#dokumen' ) )
                                .then( editor => {
                                    const toolbarContainer = document.querySelector( '#toolbar-container' );

                                    toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                                } )
                                .catch( error => {
                                    console.error( error );
                                } );
                        </script>
                        <div>
                        <label for="admintim">Pilih Admin Tim Tujuan:</label>
                        <select id="admintim" name="admintim">
                            @foreach($adminTimList as $adminTimId => $adminTimjabatan)
                                <option value="{{ $adminTimId }}">{{ $adminTimjabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary">Pengajuan Ulang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('ck-editor')
    @include('ckeditor/setting')
@endsection
