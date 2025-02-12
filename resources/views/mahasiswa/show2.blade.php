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
                        <p>
                            Nama : {{ $pinjams->nama }}
                        </p>
                        <hr>
                        <p>
                            NIM : {{ $pinjams->nim }}
                        </p>
                        <hr>
                        <p>
                            Kelas : {{ $pinjams->kelas }}
                        </p>
                        <hr>
                        <p>
                            Alat : {{ $pinjams->alat }}
                        </p>
                        <hr>
                        <p>
                            Jml Pinjam : {{ $pinjams->jumlah }}
                        </p>
                        <hr>
                        <p>
                            Email : {{ $pinjams->email }}
                        </p>
                        <hr>
                        <p>
                            Keperluan : {{ $pinjams->keperluan }}
                        </p>
                        <hr>
                        <p>
                            Status : {{ $pinjams->status }}
                        </p>
                        <hr>
                        <p>Keterangan :</p>
                        <textarea class="form-control" rows="5" readonly>{{ $pinjams->keterangan }}</textarea>
                        <hr>
                        <p>
                            Awal Peminjaman : {{ $pinjams->created_at }}
                        </p>
                        <hr>
                        <p>
                            Perubahan terakhir : {{ $pinjams->updated_at }}
                        </p>
                        <div class="text-center mt-5">
                            <a href="/pinjaman" class="btn btn-md btn-secondary mx-5">Kembali</a>
                            <button type="button" class="btn btn-md btn-success mx-5" data-toggle="modal"
                                data-target="#completeModal">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Complete Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="completeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeModalLabel">Selesaikan Pinjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyelesaikan pinjaman ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="{{ route('admin.ending', ['id' => $pinjams->id]) }}" class="btn btn-success">Selesai</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-content')
@endsection

@section('css-content')
@endsection
