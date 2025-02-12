@extends('layouts.master-layout')

@section('main-content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('admin.update2', $alats->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <a href="/pinjaman" class="btn btn-md btn-secondary mb-5">Kembali</a>

                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Mahasiswa</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama', $alats->nama) }}" readonly>

                                <!-- error message untuk nama alat -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim"
                                    value="{{ old('nim', $alats->nim) }}" readonly>

                                <!-- error message untuk nama alat -->
                                @error('nim')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Kelas</label>
                                <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                    name="kelas" value="{{ old('kelas', $alats->kelas) }}" readonly>

                                <!-- error message untuk nama alat -->
                                @error('kelas')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Nama Alat</label>
                                <input type="text" class="form-control @error('alat') is-invalid @enderror"
                                    name="alat" value="{{ old('alat', $alats->alat) }}" readonly>

                                <!-- error message untuk nama alat -->
                                @error('alat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Apakah alat rusak?</label>
                                <br>
                                <label>
                                    <input type="radio" name="status" value="Rusak"
                                        {{ $alats->status == 'Rusak' ? 'checked' : '' }}> Rusak
                                </label>
                                <label>
                                    <input type="radio" name="status" value=""
                                        {{ $alats->status == '' ? 'checked' : '' }}> Tidak
                                </label>
                            </div>

                            <div class="form-group mb-5">
                                <label class="font-weight-bold">Keterangan</label>
                                <label class="font-weight-bold">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror mb-5" name="keterangan" rows="5"
                                    placeholder="Masukkan Keterangan" oninput="limitChars(this, 75)">{{ old('keterangan', $alats->keterangan) }}</textarea>





                                <!-- error message untuk content -->
                                @error('keterangan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-center" style="display: grid; grid-template-columns: 4fr 1fr 2fr 1fr 4fr">
                                <div></div>
                                <button type="submit" class="btn btn-md btn-primary">Update</button>
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
    {{-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> --}}
    {{-- <script>
        CKEDITOR.replace('keterangan');
    </script> --}}
@endsection


@section('js-content')
    <script>
        function limitChars(textarea, maxLength) {
            var text = textarea.value;
            var lines = text.split("\n");

            for (var i = 0; i < lines.length; i++) {
                if (lines[i].length > maxLength) {
                    lines[i] = lines[i].substring(0, maxLength);
                }
            }

            textarea.value = lines.join("\n");
        }
    </script>
@endsection
