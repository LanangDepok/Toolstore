<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Admin Toolstore @yield('head-title')</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-WaF5JBRwRJhdXEdHu8/46aPF1Bw6rttvA5m8WTjhr14SZ7W7xjnTsWzTLPxwoUg/+1RKkNL7A8G8WXQ4PQdQxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/css/sb-admin-2.css" rel="stylesheet">

    @yield('css-content')

</head>


<body class="bg-gradient-Success">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center align-items-center">

            <div class="col-xl-10 col-lg-15 col-md-9 mt-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="name"
                                                name="name" placeholder="Username" required autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="showPassword">
                                                <label class="custom-control-label" for="showPassword">Show
                                                    Password</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            <i class="fas fa-sign-in-alt fa-fw"></i> Login
                                        </button>
                                    </form>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        // Ambil elemen checkbox dan input password
        var showPasswordCheckbox = document.getElementById('showPassword');
        var passwordInput = document.getElementById('password');

        // Tambahkan event listener untuk memantau perubahan status checkbox
        showPasswordCheckbox.addEventListener('change', function() {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text'; // Tampilkan password
            } else {
                passwordInput.type = 'password'; // Sembunyikan password
            }
        });
    </script>
</body>

</html>
