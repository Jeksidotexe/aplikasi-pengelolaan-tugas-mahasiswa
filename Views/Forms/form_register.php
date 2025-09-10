<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="Assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="Assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="Assets/AdminLTE/dist/css/adminlte.min.css">
    <style>
        body {
            background-image: url('Assets/Images/bg.jpg');
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <img src="Assets/Images/logo.png" height="80" width="200">
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Registrasi Pengguna Baru</p>
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>

                <form id="registrationForm" action="register.php" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-15">
                        <button type="submit" id="submitBtn" class="btn btn-warning btn-block">Register</button>
                    </div>
                </form>

                <p class="text-center mb-2 mt-3">Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="Assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="Assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="Assets/AdminLTE/dist/js/adminlte.min.js"></script>
    <!-- Sweetalert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#registrationForm").on("submit", function(e) {
            e.preventDefault(); // Anda bisa membiarkan ini untuk melakukan AJAX jika diperlukan

            $.ajax({
                type: "POST",
                url: "register.php",
                data: $(this).serialize(),
                success: function(response) {
                    // Isi response sesuai dengan cara Anda menanganinya
                    Swal.fire({
                        title: 'Selamat!',
                        text: 'Registrasi Berhasil!',
                        icon: 'success',
                        confirmButtonText: 'Tutup'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'login.php';
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Tangani kesalahan yang mungkin terjadi
                    Swal.fire({
                        title: 'Error!',
                        text: 'Registrasi Gagal: ' + xhr.responseText,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });
    </script>
</body>

</html>