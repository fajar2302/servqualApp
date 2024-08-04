<?php
session_start();
// session_destroy();
// session_unset();
include 'koneksi.php';

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];


    $query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE roles = 'responden'");
    $query_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan");
    $query_kuisioner = mysqli_query($koneksi, "SELECT * FROM tb_judul");
    $query_jenisKuisioner = mysqli_query($koneksi, "SELECT * FROM tb_jeniskuisioner");
    $jumlah_kuesioner = mysqli_num_rows($query_kuisioner);
    $jumlah_responden = mysqli_num_rows($query);
    $jumlah_pertanyaan = mysqli_num_rows($query_pertanyaan);
    $jenis_kuisioner = mysqli_num_rows($query_jenisKuisioner);
} else {
    header("Location: login/login.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ServApp</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index-admin.php">Servqual App</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item" href="login/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index-admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="kelola/kelola.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Kelola Kuesioner
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Hasil Kuesioner
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="hasil-page/hasil.php"> Hasil perhitungan
                                </a>
                                <a class="nav-link collapsed" id="pengujian" href="#"> Pengujian Kuesioner</a>
                                <a class="nav-link collapsed" id="servqual" href="#"> SERVQUAL </a>

                            </nav>
                        </div>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <p class="text-center">ADMIN</p>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main id="main-container">
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="help d-flex position-relative mb-3">
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <a href="" class="ms-auto position-absolute top-10 end-0 mb-4 text-decoration-none"
                            id="bantuan">Perlu Bantuan?</a>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary mb-4">
                                <div class="card-body">
                                    <p class="fs-5 fw-bold text-white" style="font-size: 40px !important">
                                        <?= $jumlah_responden ?></p>
                                    <p class="text-white">Data Responden</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <p class="fs-5 fw-bold text-white" style="font-size: 40px !important">
                                        <?= $jumlah_kuesioner ?></p>
                                    <p class="text-white">Data Kuesioner</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <p class="fs-5 fw-bold text-white" style="font-size: 40px !important">
                                        <?= $jumlah_pertanyaan ?></p>
                                    <p class="text-white">Data Pertanyaan</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">
                                    <p class="fs-5 fw-bold text-white" style="font-size: 40px !important">
                                        <?= $jenis_kuisioner ?>
                                    </p>
                                    <p class="text-white">Data Jenis Kuesioner</p>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-4" id="form-load">
                        <!-- load form edit and open -->
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Tabel Responden
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="tabel">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Umur</th>
                                        <th>Pekerjaan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($data = mysqli_fetch_assoc($query)) {
                                        $id_user = $data['username'];
                                        $nama = $data['nama'];
                                        $jenkel = $data['jenis_kelamin'];
                                        $alamat = $data['alamat'];
                                        $umur = $data['umur'];
                                        $pekerjaan = $data['pekerjaan'];
                                        // $pekerjaan = $data['pekerjaan'];
                                        // $tgl_pengisian = $data['tgl_pengisian'];
                                    ?>
                                    <tr>
                                        <td><?= $nama ?></td>
                                        <td><?= $jenkel ?></td>
                                        <td><?= $alamat ?></td>
                                        <td><?= $umur ?></td>
                                        <td><?= $pekerjaan ?></td>
                                        <td>
                                            <a href="">
                                                <button type="button" class="btn btn-primary btn-sm open"
                                                    open-id=<?= $id_user ?>>
                                                    <i class="bi bi-info-circle"></i> Lihat
                                                </button>
                                            </a>
                                            <a href="">
                                                <button type="button" class="btn btn-success btn-sm edit"
                                                    edit-id=<?= $id_user ?>>
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </button>
                                            </a>
                                            <a href="">
                                                <button type="button" class="btn btn-danger btn-sm hapus"
                                                    hapus-id=<?= $id_user ?>>
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- modals -->
                <div class="row-justify-content-center">
                    <div class="modal mt-4 mx-auto" tabindex="-1" id="modalShow">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" id="headerModal">
                                    <h5 class="modal-title" id="modalTittle"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body pt-1 pb-0" id="bdModalKuisioner"></div>
                                <div class="modal-footer mt-3">
                                    <p style="color:#777474;">&copy; <?php echo date("Y") ?> Febrian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modals -->
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; ServApp 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="library/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
    $(document).ready(function() {
        $('.edit').on('click', function(e) {
            e.preventDefault();

            let data = $(this).attr('edit-id');

            $.post('responden-page/edit.php', {
                id: data,
            }, function(response) {
                $('#form-load').html(response);
            })

        })
        $('.open').on('click', function(e) {
            e.preventDefault();

            let data = $(this).attr('open-id');
            $('#modalShow').modal('show');
            $('#modalTittle').html('Responden Info');
            $.post('responden-page/open.php', {
                id: data,
            }, function(respon) {
                $('#bdModalKuisioner').html(respon);
                $('#headerModal').removeClass();
                $('#headerModal').addClass('modal-header bg-primary text-white')
            })


        })
        $('.hapus').on('click', function(e) {
            e.preventDefault();

            var id = $(this).attr('hapus-id');
            Swal.fire({
                title: 'Yakin Ingin Menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('responden-page/proses.php', 'hapus=' + id, function(respon) {
                        var pecah = respon.split('|');
                        Swal.fire({
                            position: 'center',
                            icon: pecah[0],
                            title: pecah[1],
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $(window).attr('location', 'index-admin.php');
                    })
                }
            })




        })


        $('#pengujian').on('click', function(e) {
            e.preventDefault();
            $('#main-container').load('hasil-page/pengujian-page/pengujian-page.php');

        })
        $('#servqual').on('click', function(e) {
            e.preventDefault();
            $('#main-container').load('hasil-page/servqual-page/servqual-page.php');
        })
        $('#bantuan').on('click', function(e) {
            e.preventDefault();
            $('#main-container').load('help/support-admin.html');
        })
    })
    </script>
</body>

</html>