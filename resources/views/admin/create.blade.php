@extends('layouts.master-layout')

@section('main-content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <a href="/admin" class="btn btn-md btn-secondary mb-5">Kembali</a>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Gambar (format : jpeg,jpg,png)</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">

                                <!-- error message untuk image -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Alat (Tidak boleh sama)</label>
                                <input type="text" class="form-control @error('nama_alat') is-invalid @enderror"
                                    name="nama_alat" value="{{ old('nama_alat') }}">

                                <!-- error message untuk nama alat -->
                                @error('nama_alat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Jumlah</label>
                                <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                                    name="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan angka!">

                                <!-- error message untuk jumlah -->
                                @error('jumlah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Tempat</label>
                                <input type="text" class="form-control @error('tempat') is-invalid @enderror"
                                    name="tempat" value="{{ old('tempat') }}">

                                <!-- error message untuk nama alat -->
                                @error('tempat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label class="font-weight-bold">Kategori</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                    name="kategori" value="{{ old('kategori') }}">

                                <!-- error message untuk nama alat -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-center" style="display: grid; grid-template-columns: 4fr 1fr 2fr 1fr 4fr">
                                <div></div>
                                <button type="submit" class="btn btn-md btn-primary"
                                    onclick="showSuccessModal()">Simpan</button>
                                <div></div>
                                <button type="reset" class="btn btn-md btn-warning">Reset</button>
                                <div></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Sukses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Barang berhasil ditambahkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-content')
    <script>
        function showSuccessModal() {
            $('#successModal').modal('show');
        }
    </script>
@endsection

@section('css-content')
@endsection
