<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="Assets/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="Assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="Assets/AdminLTE/dist/css/adminlte.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" />
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="Assets/Images/logo2.png" alt="WelcomeLogo" height="50" width="50">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashborad.php" class="nav-link">Home</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <!-- <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul> -->
            <div class="navbar-nav ml-auto user-panel mr-3">
                <div class="image">
                    <img src="Assets/Images/<?php echo htmlspecialchars($userFoto); ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="dashboard_profil.php" class="text-light d-block"><?php echo htmlspecialchars($dataUser['nama']); ?></a>
                </div>
            </div>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="dashboard.php" class="brand-link">
                <img src="Assets/Images/logo2.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8" height="50" weight="50">
                <span class="brand-text font-weight-light">TugasKu</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="Assets/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">DATA MASTER</li>
                        <li class="nav-item">
                            <a href="dashboard_kategori.php" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard_tugas.php" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Tugas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard_prioritas.php" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Prioritas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard_komentar.php" class="nav-link">
                                <i class="nav-icon fas fa-comment"></i>
                                <p>
                                    Komentar
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">NOTIFIKASI</li>
                        <li class="nav-item">
                            <a href="dashboard_pengingat.php" class="nav-link">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>
                                    Pengingat
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">PENGGUNA</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Profil
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">SISTEM</li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit Pengingat</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Edit Pengingat</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="button">
                                        <a href="dashboard_pengingat.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    </div>
                                </div>
                                <form id="editPengingatForm" action="editPengingat.php?id=<?php echo htmlspecialchars($dataPengingat['id']); ?>" method="post">
                                    <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($dataPengingat['id']); ?>">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Tugas</label>
                                            <select class="form-control" name="id_tugas" id="id_tugas" required>
                                                <option value="">-- Pilih Tugas --</option>
                                                <?php if ($dataTugas) : ?>
                                                    <?php foreach ($dataTugas as $t) : ?>
                                                        <option value="<?= htmlspecialchars($t['id']) ?>" <?= (isset($dataPengingat['id_tugas']) && $dataPengingat['id_tugas'] == $t['id']) ? 'selected' : '' ?>>
                                                            <?= htmlspecialchars($t['judul']) ?></option>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="">Tidak ada pengingat yang tersedia</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Waktu:</label>
                                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                                <input type="text" name="waktu" id="waktu" class="form-control datetimepicker-input" data-target="#reservationdatetime" value="<?php echo htmlspecialchars($dataPengingat['waktu']); ?>">
                                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <li class="fa fa-print"></li> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025.</strong>
            <div class="float-right d-none d-sm-inline-block">
                Developed By <b>Zaki</b>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="Assets/AdminLTE/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="Assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="Assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="Assets/AdminLTE/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="Assets/AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="Assets/AdminLTE/plugins/raphael/raphael.min.js"></script>
    <script src="Assets/AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="Assets/AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="Assets/AdminLTE/plugins/chart.js/Chart.min.js"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="Assets/AdminLTE/dist/js/pages/dashboard2.js"></script>

    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $(function() {
            // Inisialisasi datetimepicker
            $('#reservationdatetime').datetimepicker({
                format: 'YYYY-MM-DD HH:mm', // Mengaturnya ke format datetime
                icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check',
                    clear: 'fas fa-trash',
                    close: 'fas fa-times'
                }
            });
        });
    </script>

    <!-- Sweetalert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#editPengingatForm").on("submit", function(e) {
            e.preventDefault(); // Mencegah form dari pengiriman default

            $.ajax({
                type: "POST",
                url: "editPengingat.php?id=" + $("#id").val(), // Jika menggunakan ID
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Tutup'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = 'dashboard_pengingat.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Gagal mengubah pengingat: ' + xhr.responseText,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            });
        });
    </script>
</body>

</html>