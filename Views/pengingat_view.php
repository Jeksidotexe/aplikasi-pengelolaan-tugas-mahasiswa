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
</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="Assets/Images/logo2.png" alt="WelcomeLogo" height="50" width="50">
        </div> -->

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
                            <a href="dashboard_profil.php" class="nav-link">
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
                            <h1 class="m-0">Pengingat</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Pengingat</li>
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
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="button">
                                                <a href="tambahPengingat.php" class="btn btn-primary">
                                                    <li class="fa fa-plus"></li> Tambah Pengingat
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <form class="search" method="get">
                                                <div class="input-group">
                                                    <input class="form-control" name="search_pengingat" type="text" placeholder="Cari Pengingat" value="<?= htmlspecialchars($searchPengingat); ?>">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search fa-fw"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Judul</th>
                                                <th>Waktu</th>
                                                <th style="width: 100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($dataPengingat): ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($dataPengingat as $p): ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= htmlspecialchars($p['judul']); ?></td>
                                                        <td><?= htmlspecialchars($p['waktu']); ?></td>
                                                        <td>
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="editPengingat.php?id=<?= htmlspecialchars($p['id']) ?>" class="btn btn-sm btn-warning mr-2"><i class="fas fa-edit"></i></a>
                                                                <form class="hapusPengingat" action="hapusPengingat.php" method="post">
                                                                    <input type="hidden" name="id" value="<?= htmlspecialchars($p['id']) ?>">
                                                                    <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                                                </form>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6">Tidak ada data pengingat.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?= $page - 1; ?>">«</a>
                                        </li>
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                            <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                            </li>
                                        <?php endfor; ?>
                                        <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?= $page + 1; ?>">»</a>
                                        </li>
                                    </ul>
                                </div>
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

    <audio id="notificationSound" src="Assets/Sounds/notif.mp3" preload="auto"></audio>

    <script type="text/javascript">
        // Fungsi untuk memeriksa dan memutar audio notifikasi
        function checkReminderAndPlay() {
            const reminders = <?= json_encode($dataPengingat); ?>;

            // Cek jika ada pengingat
            if (reminders.length > 0) {
                const notificationSound = document.getElementById('notificationSound');
                notificationSound.play(); // Putar suara notifikasi

                reminders.forEach(reminder => {
                    alert(`Pengingat: Tugas '${reminder.judul}' mendekati deadline pada ${reminder.waktu}!`);
                    // Anda dapat memperkaya notifikasi dengan UI yang lebih baik jika ingin
                });
            }
        }

        // Panggil fungsi saat halaman dimuat
        window.onload = checkReminderAndPlay;
    </script>

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

    <!-- Sweetalert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(".hapusPengingat").on("submit", function(e) {
            e.preventDefault(); // Mencegah form dari pengiriman default

            // Konfirmasi penghapusan kepada pengguna
            Swal.fire({
                title: "Yakin ingin menghapus pengingat ini?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#655CC9",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna yakin, lanjutkan dengan pengiriman AJAX
                    $.ajax({
                        type: "POST",
                        url: "hapusPengingat.php",
                        data: $(this).serialize(), // Ambil data dari form
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.message,
                                    icon: "success"
                                });
                                // Hapus baris dari tabel jika berhasil
                                // ini bergantung pada struktur HTML Anda
                                $(e.target).closest('tr').remove(); // Ganti '.closest('tr')' jika perlu disesuaikan
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    confirmButtonText: 'Tutup'
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal menghapus pengingat: ' + xhr.responseText,
                                icon: 'error',
                                confirmButtonText: 'Tutup'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>