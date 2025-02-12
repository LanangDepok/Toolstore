@extends('layouts.master-layout')

@section('main-content')
    <style>
        .aksi-col {
            max-width: 250px;
            /* Atur lebar maksimal sesuai kebutuhan Anda */
            overflow: hidden;
            text-overflow: ellipsis;
            /* white-space: nowrap; */
        }
    </style>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Daftar Permintaan</h3>
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
                                    <th scope="col">Alat</th>
                                    <th scope="col">Jml Pinjam</th>
                                    {{-- <th scope="col">Tempat</th> --}}
                                    <th scope="col">Keperluan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @forelse ($pinjams as $pinjam)
                                    <tr class="text-center">
                                        <td>{{ $i++ }}</td>
                                        <td>{!! wordwrap($pinjam->nama, 20, '<br>', true) !!}</td>
                                        <td>{{ $pinjam->nim }}</td>
                                        {{-- <td>{{ $pinjam->kelas }}</td> --}}
                                        <td>{!! wordwrap($pinjam->alat, 15, '<br>', true) !!}</td>
                                        <td>{{ $pinjam->jumlah }}</td>
                                        {{-- <td>{{ $pinjam->tempat }}</td> --}}
                                        <td>{{ $pinjam->keperluan }}</td>
                                        <td class="aksi-col">
                                            <form method="POST" action="{{ route('admin.destroy2', $pinjam->id) }}">
                                                <a href="{{ route('mahasiswa.show', $pinjam->id) }}"
                                                    class="btn btn-sm btn-dark"><i class="fas fa-info-circle"></i></a>
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#terimaModal{{ $pinjam->id }}"><i
                                                        class="fas fa-check"></i></button>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#tolakModal{{ $pinjam->id }}"><i
                                                        class="fas fa-times"></i></button>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Terima -->
                                    <div class="modal fade" id="terimaModal{{ $pinjam->id }}" tabindex="-1"
                                        aria-labelledby="terimaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="terimaModalLabel">Terima Pinjaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menerima pinjaman ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <a href="{{ route('admin.selesai', ['id' => $pinjam->id]) }}"
                                                        class="btn btn-primary">Terima</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Tolak -->
                                    <div class="modal fade" id="tolakModal{{ $pinjam->id }}" tabindex="-1"
                                        aria-labelledby="tolakModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tolakModalLabel">Tolak Pinjaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menolak pinjaman ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <form method="POST"
                                                        action="{{ route('admin.destroy2', $pinjam->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
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
