<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toolstore</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js"></script>
    <script src="/jquery/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>

<body style="background: #d3e5ea">

    <div class="container-fluid bg-success">
        <nav class="navbar navbar-expand-lg bg-body-primary">
            <div class="container-fluid">
                <a class="navbar-brand mx-auto text-white" href="#" style="font-size: 40px">Peminjaman Tools</a>
            </div>
        </nav>
    </div>

    <div class="container mx-auto mt-5" style="width: 80%">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-mahasiswa-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Pengajuan peminjaman alat</h1>
                            </div>
                            <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama">
                                        @error('nama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                            id="nim" name="nim">
                                        @error('nim')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kelas" class="col-sm-3 col-form-label">Kelas</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('kelas') is-invalid @enderror"
                                            id="kelas" name="kelas">
                                        @error('kelas')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email PNJ</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" placeholder="@mhsw.pnj.ac.id" name="email">
                                        @error('email')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleDataList" class="col-sm-3 col-form-label">Barang</label>
                                    <div class="col-sm-9">
                                        <select class="form-control js-example-basic-single" id="exampleDataList"
                                            name="alat">
                                            <option value="" selected disabled>Pilih nama barang</option>
                                            @foreach ($alats as $arr => $value)
                                                <option value="{{ $value['id'] }}">{{ $value['nama_alat'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('jumlah') is-invalid @enderror"
                                            id="jumlah" name="jumlah" placeholder="Masukkan angka!">
                                        @error('jumlah')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="exampleDataList" class="col-sm-3 col-form-label">Keperluan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="exampleDataList" name="keperluan">
                                            <option value="" selected disabled>Pilih</option>
                                            <option value="Dalam Kampus">Dalam Kampus</option>
                                            <option value="Luar Kampus">Luar Kampus</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-3 col-form-label font-weight-bold">Foto KTM
                                        (format : jpeg,jpg,png)</label>
                                    <div class="col-sm-9">
                                        <input type="file"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            id="image">
                                        @error('image')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <a href="/main" class="btn btn-danger mx-5">Kembali</a>
                                    <button type="submit" class="btn btn-primary mx -5"
                                        onclick="return cek() ? showSuccessNotification() : showFailureNotification()">Pinjam</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal for Success -->
    <div class="modal fade" id="failureModal" tabindex="-1" aria-labelledby="failureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="failureModalLabel">Peminjaman Gagal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Barang gagal dipinjam!
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Peminjaman Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Barang berhasil dipinjam!
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script src="/jquery/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            // Function to show success notification and open success modal
            function showFailureNotification() {
                // Your code to show a success notification, if desired

                // Open the success modal
                $('#failureModal').modal('show');
            }

            function showSuccessNotification() {
                // Your code to show a success notification, if desired

                // Open the success modal
                $('#successModal').modal('show');
            }

            function cek() {
                var nama = document.getElementById("nama").value;
                var nim = document.getElementById("nim").value;
                var kelas = document.getElementById("kelas").value;
                var email = document.getElementById("email").value;
                var barang = document.getElementById("exampleDataList").value;
                var jumlah = document.getElementById("jumlah").value;
                var image = document.getElementById("image").value;

                if (nama === '' || nim === '' || kelas === '' || email === '' || barang === '' || jumlah === '' || image ===
                    '') {
                    return false;
                } else {
                    return true;
                }
            }

            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
        </script>

</body>

</html>
