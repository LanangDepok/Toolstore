@extends('layouts.master-layout')

@section('main-content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('storage/gambar/' . $pinjams->image) }}" class="w-100 rounded">
                        </div>
                        <hr>
                        <div class="text-center mb-4">
                            <h3>{{ $pinjams->nama }}</h3>
                        </div>
                        <p>
                            NIM : {{ $pinjams->nim }}
                        </p>
                        <p>
                            Kelas : {{ $pinjams->kelas }}
                        </p>
                        <p>
                            Alat : {{ $pinjams->alat }}
                        </p>
                        <p>
                            Jml Pinjam : {{ $pinjams->jumlah }}
                        </p>
                        <p>
                            Email : {{ $pinjams->email }}
                        </p>
                        <p>
                            Tempat : {{ $pinjams->tempat }}
                        </p>
                        <p>
                            Keperluan : {{ $pinjams->keperluan }}
                        </p>
                        <p>
                            Diajukan pada : {{ $pinjams->created_at }}
                        </p>
                        <div class="text-center mt-5">
                            <a href="/daftar_pinjam" class="btn btn-md btn-secondary mx-5">Kembali</a>
                            <button type="button" class="btn btn-md btn-primary mx-5" data-toggle="modal"
                                data-target="#acceptModal">Terima</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Accept Modal -->
    <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptModalLabel">Terima Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menerima pinjaman ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{ route('admin.selesai', ['id' => $pinjams->id]) }}" class="btn btn-primary">Terima</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-content')
@endsection

@section('css-content')
@endsection
