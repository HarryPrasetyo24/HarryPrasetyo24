<?php
session_start();
include_once("frontend/function/helper.php");
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

	if($user_id){
		header("location: ".BASE_URL);
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Document</title>
    <link rel="stylesheet" href="frontend/libraries/boostrap/css/bootstrap.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300;400;500;600;700;800&
    family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="frontend/styles/main.css" />
</head>

<body>
    <!-- Navbar -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow">
            <a href="index.html" class="navbar-brand">
                <img src="frontend/images/logo.png" alt="Logo PHARMACY" />
            </a>
            <button class="navbar-toggler navbar-toogler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-md-2">
                        <a href="index.html" class="nav-link">Beranda</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="berita_kesehatan.html" class="nav-link">Berita Kesehatan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="produk.html" class="nav-link dropdown-toggle" id="navbardrop"
                            data-bs-toggle="dropdown">
                            Produk
                        </a>
                        <div class="dropdown-menu">
                            <a href="produk.php?kategori_id=1" class="dropdown-item">Obat Generik</a>
                            <a href="produk.php?kategori_id=2" class="dropdown-item">Obat Bebas</a>
                            <a href="produk.php?kategori_id=3" class="dropdown-item">Alat Kesehatan</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- akhir Navbar -->

    <main>
        <section class="section-login-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 images-login-header pl-lg-0">
                        <img src="frontend/images/bg-login.jpg" alt="" />
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-12 col-md-6 col-lg-5 login-content">
                        <h3>
                            Masuk dan Belanja Kebutuhan <br />
                            Kesehatan Anda
                        </h3>
                        <form action="proses_login.php" method="POST" class="mt-3">
                            <?php
			                      
                            $notif = isset($_GET['notif'])? $_GET['notif'] : false;
		
			                      if($notif == "true"){
			                      	echo "<div class='notif mb-4'>Maaf, email atau password yang anda masukkan salah atau 
                              </br> tidak ada </div>";
			                      }
			
		                      ?>
                            <div class="form-group mb-4">
                                <label>Masukkan Email</label>
                                <input type="email" class="form-control w-75" aria-describedby="emailHelp"
                                    name="email" />
                            </div>

                            <div class="form-group mb-4">
                                <label>Masukkan Kata Sandi</label>
                                <input type="password" class="form-control w-75" name="password" />
                            </div>
                            <button type="submit" class="btn btn-success btn-block w-75 mt-4 mb-2">
                                Masuk
                            </button>
                            <a class="btn btn-signup w-75 mt-2" href="register.html">
                                Daftar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="frontend/libraries/jquery/jquery-3.6.0.min.js"></script>
    <script src="frontend/libraries/boostrap/js/bootstrap.js"></script>
    <script src="frontend/libraries/retina/retina.min.js"></script>
</body>

</html>