@extends('layouts.master-layout')

@section('main-content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('storage/gambar/' . $alats->image) }}" class="w-100 rounded">
                        </div>
                        <hr>
                        <div class="text-center mb-4">
                            <h3>{{ $alats->nama_alat }}</h3>
                        </div>
                        <p>
                            Jumlah : {{ $alats->jumlah }}
                        </p>
                        <p>
                            Tempat : {{ $alats->tempat }}
                        </p>
                        <p>
                            Kategori : {{ $alats->kategori }}
                        </p>
                        <p>
                            Dibuat pada : {{ $alats->created_at }}
                        </p>
                        <p>
                            Perubahan terakhir : {{ $alats->updated_at }}
                        </p>
                        <div class="text-center mt-5">
                            <a href="/admin" class="btn btn-md btn-secondary">Kembali</a>
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
