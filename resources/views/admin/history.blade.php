@extends('layouts.master-layout')

@section('main-content')
    <style>
        .aksi-col {
            max-width: 150px;
            /* Atur lebar maksimal sesuai kebutuhan Anda */
            overflow: hidden;
            text-overflow: ellipsis;
            /* white-space: nowrap; */
        }

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
                    <h3 class="text-center my-4">History</h3>
                    <div class="mx-auto" style="width: 25%">
                        <input type="text" id="searchInput" placeholder="Cari di sini..." class="form-control mt-2">
                        <select id="yearFilter" class="form-control mt-2">
                            <option value="">Semua</option>
                            @php
                                $years = [];
                            @endphp
                            @foreach ($pinjams as $pinjam)
                                @php
                                    $createdAt = \Carbon\Carbon::parse($pinjam->created_at);
                                    $year = $createdAt->format('Y');
                                @endphp
                                @if (!in_array($year, $years))
                                    <option value="{{ $year }}">{{ $year }}</option>
                                    @php
                                        $years[] = $year;
                                    @endphp
                                @endif
                            @endforeach
                        </select>
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
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Alat</th>
                                    <th scope="col">Selesai</th>
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
                                        <td>{{ $pinjam->kelas }}</td>
                                        <td>{!! wordwrap($pinjam->alat, 15, '<br>', true) !!}</td>
                                        <td>{{ $pinjam->created_at }}</td>
                                        <td class="aksi-col">
                                            <form method="POST">
                                                @csrf
                                                <a href="{{ route('mahasiswa.show3', $pinjam->id) }}"
                                                    class="btn btn-sm btn-dark">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('exportpdf', ['id' => $pinjam->id]) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa fa-download"></i>
                                                </a>
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

        // Ambil elemen select tahun
        var yearFilterSelect = document.getElementById('yearFilter');

        // Tambahkan event listener untuk memantau perubahan input dan select tahun
        searchInput.addEventListener('input', applyFilters);
        yearFilterSelect.addEventListener('change', applyFilters);

        // Fungsi untuk menerapkan filter
        function applyFilters() {
            var filter = searchInput.value.toLowerCase();
            var yearFilter = yearFilterSelect.value;

            // Ambil semua baris data dalam tabel
            var rows = Array.from(table.querySelectorAll('tbody tr'));

            rows.forEach(function(row) {
                var rowMatch = false;

                // Loop melalui setiap sel dalam baris data
                var cells = Array.from(row.querySelectorAll('td'));

                cells.forEach(function(cell, index) {
                    var cellText = cell.textContent.toLowerCase();

                    // Periksa apakah nilai kolom cocok dengan filter
                    if (cellText.includes(filter) && index < columnHeaders.length && cell.querySelector(
                        'a') === null) {
                        rowMatch = true;
                    }
                });

                // Periksa apakah tahun sesuai
                var yearCell = row.querySelector('td:nth-child(6)').textContent;
                if (yearFilter !== '' && !yearCell.includes(yearFilter)) {
                    rowMatch = false;
                }

                // Tentukan apakah baris harus ditampilkan atau disembunyikan
                if (rowMatch) {
                    row.style.display = ''; // Tampilkan baris
                } else {
                    row.style.display = 'none'; // Sembunyikan baris
                }
            });
        }
    </script>
@endsection
