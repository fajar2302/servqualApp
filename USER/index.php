<?php
include '../koneksi.php';
session_start();


$id = $_SESSION['id'];
$cek = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$id'");
if (mysqli_num_rows($cek) > 0) {
    $query = mysqli_fetch_assoc($cek);
    $nama = $query['nama'];
} else {
    header("Location: ../login/login.html");
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style-home.css" />

    <!-- link Jquery 3.6.4 -->
    <script src="../library/jquery-3.6.4.min.js"></script>

    <!-- link icon bootstrap -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <!-- link Sweet Allert -->
    <script src="../library/sweetAllert2.min.js"></script>


    <title>Pengolahan Data</title>
    <style>
    #user .btn {
        background-color: #0c3c53 !important;
        color: white;
    }

    #user .btn:hover {
        background-color: #0c3c53 !important;
        color: white;
    }

    .bg-custom {
        background-color: #0c3c53 !important
    }
    </style>

</head>

<body>

    <!-- =========== HEADER ============ -->
    <header id="header">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark" style="background-color: #0c3c53 !important;">
            <div class="container">
                <a class="navbar-brand" href="#">Servqual App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse mx-auto" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="index.php">Home</a>
                        <a class="nav-link" href="#" id="descri">Description</a>
                        <a class="nav-link" id="kuis" href="#">Kuesioner</a>
                        <!-- <a class="nav-link" id="kuis" href="#">Daftar Kuis</a> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> Profile
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#"><span class="me-2">
                                            <i class="bi bi-person-lines-fill"></i></span><?= $nama ?></a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="../login/logout.php"><span class="me-2"><i
                                                class="bi bi-box-arrow-right"></i></span>Keluar</a></li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <!-- ============ MAIN ============ -->
    <main id="main-page">
        <!-- ============ HERO ============ -->
        <section class="hero" id="hero">
            <div class="container my-5">
                <h4 class="text text-center pb-4">PENGUKURAN KUALITAS LAYANAN</h4>
                <p class="text pt-4 mt-4 text-center">"Pengalaman Unggul dengan ServQual: Kualitas Layanan yang Terukur
                    dan
                    Ditingkatkan!"</p>
            </div>
            <div class="d-grid col-2 mx-auto text button">
                <button id="btn-kuis" type="button" class="btn btn-primary btn-lg ">Lihat Kuesioner</button>
            </div>
        </section>

        <!-- =========== FEATURES =========== -->
        <section data-aos="fade-up" class="mt-5 mb-3 pt-4 pb-2 features" id="description">
            <div class="pt-2 features-body">
                <div class="section-title">
                    <h4 class="fw-bold text-center text-uppercase">Description</h4>
                </div>
                <div class="row mt-4 pt-3 justify-content-center">
                    <div class="col-sm-7 column col-md-7 col-lg-7 col-xl-5 text-center">
                        <img src="../assets/picture/features.png" alt="" width="400" height="300" />
                    </div>
                    <div class="col-sm-7 column col-md-7 col-lg-7 col-xl-7">
                        <p class="fs-5 py-4 my-3" style="text-align: justify;">
                            Fitur yang disediakan oleh aplikasi pengukuran kualitas layanan menggunakan ServQual
                            memungkinkan peneliti
                            melihat hasil pengolahan data secara visual melalui grafik dan data yang menggunakan metode
                            ServQual.
                            Dengan fitur
                            ini, proses evaluasi kualitas layanan menjadi lebih mudah dipahami dan memberikan wawasan
                            yang lebih
                            mendalam bagi pengguna aplikasi.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========== ABOUT =========== -->
        <section data-aos="fade-up" class="about" id="about">
            <div class="about-body">
                <div class="row my-4 py-2 justify-content-center">
                    <div class="col-sm-7 col-md-8 col-lg-7 col-xl-7">
                        <p class="py-3 fs-5" style="text-align: justify;">
                            Aplikasi ini bertujuan memberikan bantuan kepada para peneliti dalam mengolah data kuesioner
                            dengan
                            menggunakan metode Service Quality. Dengan aplikasi ini, proses pengolahan data menjadi
                            lebih efisien dan
                            hasilnya dapat
                            segera dipantau dan dievaluasi. Ini dapat meningkatkan efektivitas penelitian dan membantu
                            para peneliti
                            dalam mengambil keputusan berdasarkan analisis data yang akurat dan cepat.
                        </p>
                    </div>
                    <div class="col-sm-7 col-md-8 col-lg-7 col-xl-5 text-center">
                        <img src="../assets/picture/about.png" alt="" width="400" height="300" />
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>

    </footer>
    <script src="../library/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $('#btn-kuis').on('click', function(e) {
            e.preventDefault();
            $('#main-page').load('kuesioner-page.php');
        });
        $('#kuis').on('click', function(e) {
            e.preventDefault();
            $('#main-page').load('kuesioner-page.php');
        });
    })
    </script>

</body>

</html>