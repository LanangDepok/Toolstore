@extends('layouts.master-layout')

@section('main-content')
    <style>
        .table tbody tr[data-keterangan] {
            background-color: rgb(255, 255, 200);
        }

        .table tbody tr[data-keterangan=""] {
            background-color: rgb(255, 255, 255);
        }

        .table tbody tr[data-status="Rusak"] {
            background-color: rgb(255, 200, 200);
        }
    </style>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Daftar Peminjaman</h3>
                    <div class="mx-auto" style="width: 25%">
                        <input type="text" id="searchInput" placeholder="Cari di sini..." class="form-control">
                    </div>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Mahasiswa</th>
                                    <th scope="col">NIM</th>
                                    {{-- <th scope="col">Kelas</th> --}}
                                    <th scope="col">Jml Pinjam</th>
                                    <th scope="col">Alat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse ($pinjams as $pinjam)
                                    <tr class="text-center" data-status="{{ $pinjam->status }}"
                                        data-keterangan="{{ $pinjam->keterangan }}">
                                        <td>{{ $i++ }}</td>
                                        <td>{!! wordwrap($pinjam->nama, 20, '<br>', true) !!}</td>
                                        <td>{{ $pinjam->nim }}</td>
                                        {{-- <td>{{ $pinjam->kelas }}</td> --}}
                                        <td>{{ $pinjam->jumlah }}</td>
                                        <td>{!! wordwrap($pinjam->alat, 15, '<br>', true) !!}</td>
                                        <td>{{ $pinjam->status }}</td>
                                        <td class="aksi-col">
                                            <form method="GET">
                                                <a href="{{ route('mahasiswa.show2', $pinjam->id) }}"
                                                    class="btn btn-sm btn-dark" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.edit2', $pinjam->id) }}"
                                                    class="btn btn-sm btn-primary" title="Keterangan">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-success" title="Selesai"
                                                    data-toggle="modal" data-target="#selesaiModal{{ $pinjam->id }}">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Selesai -->
                                    <div class="modal fade" id="selesaiModal{{ $pinjam->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="selesaiModalLabel{{ $pinjam->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="selesaiModalLabel{{ $pinjam->id }}">
                                                        Konfirmasi
                                                        Selesai</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menyelesaikan peminjaman ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <a href="{{ route('admin.ending', ['id' => $pinjam->id]) }}"
                                                        class="btn btn-success">Ya, Selesaikan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Selesai -->
                                @empty
                                    <div class="alert alert-danger">
                                        Data masih kosong.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- {{ $alats->links() }} --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-content')
    <script>
        //message with toastr
        @if (session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif (session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>



    <script>
        // Ambil elemen input search bar
        var searchInput = document.getElementById('searchInput');

        // Ambil tabel
        var table = document.querySelector('table');

        // Simpan baris judul kolom dalam array
        var columnHeaderRow = table.querySelector('thead tr');

        // Simpan judul kolom dalam array
        var columnHeaders = Array.from(columnHeaderRow.querySelectorAll('th')).map(function(th) {
            return th.textContent.toLowerCase();
        });

        // Tambahkan event listener untuk memantau perubahan input
        searchInput.addEventListener('input', function() {
            var filter = searchInput.value.toLowerCase();

            // Ambil semua baris data dalam tabel
            var rows = Array.from(table.querySelectorAll('tbody tr'));

            rows.forEach(function(row) {
                var rowMatch = false;

                // Loop melalui setiap sel dalam baris data
                var cells = Array.from(row.querySelectorAll('td'));

                cells.forEach(function(cell, index) {
                    var cellText = cell.textContent.toLowerCase();

                    // Periksa apakah nilai kolom cocok dengan filter
                    if (cellText.includes(filter) && index < columnHeaders.length && cell
                        .querySelector('a') === null) {
                        rowMatch = true;
                    }
                });

                // Tentukan apakah baris harus ditampilkan atau disembunyikan
                if (rowMatch) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        });
    </script>
@endsection

@section('css-content')
@endsection
