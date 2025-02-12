@extends('layouts.master-layout')

@section('main-content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
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
                            keperluan : {{ $pinjams->keperluan }}
                        </p>
                        <hr>
                        <p>
                            status : {{ $pinjams->status }}
                        </p>
                        <hr>
                        <p>
                            Keterangan :
                        </p>
                        <textarea class="form-control" rows="5" readonly>{{ $pinjams->keterangan }}</textarea>
                        <hr>
                        <p>
                            Awal Peminjaman : {{ $pinjams->awal_pinjaman }}
                        </p>
                        <hr>
                        <p>
                            Selesai Peminjaman : {{ $pinjams->created_at }}
                        </p>
                        <div class="text-center mt-5">
                            <a href="/history" class="btn btn-md btn-secondary mx-5">Kembali</a>
                            <a href="{{ route('exportpdf', ['id' => $pinjams->id]) }}"
                                class="btn btn-md btn-primary mx-5">Download</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-content')
@endsection
@section('css-content')
@endsection
