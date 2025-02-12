@extends('layouts.master-layout')

@section('main-content')
    {{-- <style>
        .aksi-col {
            max-width: 175px;
            /* Atur lebar maksimal sesuai kebutuhan Anda */
            overflow: hidden;
            text-overflow: ellipsis;
            /* white-space: nowrap; */
        }
    </style> --}}

    <body style="background: lightgray">

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h3 class="text-center my-4">Daftar Alat</h3>
                        <div class="mx-auto" style="width: 25%">
                            <input type="text" id="searchInput" placeholder="Cari di sini..." class="form-control">
                        </div>
                        <hr>
                    </div>
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <a href="{{ route('admin.create') }}" class="btn btn-md btn-success mb-3">Tambah</a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama Alat</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Tempat</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @forelse ($alats as $alat)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('/storage/gambar/' . $alat->image) }}" class="rounded"
                                                    style="width: 150px">
                                            </td>
                                            <td>{!! wordwrap($alat->nama_alat, 15, '<br>', true) !!}</td>
                                            <td>{{ $alat->jumlah }}</td>
                                            <td>{!! wordwrap($alat->tempat, 15, '<br>', true) !!}</td>
                                            <td>{!! wordwrap($alat->kategori, 15, '<br>', true) !!}</td>
                                            <td class="aksi-col">
                                                <form action="{{ route('admin.destroy', $alat->id) }}" method="POST">
                                                    <a href="{{ route('admin.show', $alat->id) }}"
                                                        class="btn btn-sm btn-dark"><i class="fas fa-info-circle"></i></a>
                                                    <a href="{{ route('admin.edit', $alat->id) }}"
                                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#deleteModal{{ $alat->id }}"><i
                                                            class="fas fa-trash"></i></button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $alat->id }}"
                                                        tabindex="-1" aria-labelledby="deleteModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data
                                                                        Alat</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah Anda yakin ingin menghapus data alat
                                                                    "{{ $alat->nama_alat }}"?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
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
