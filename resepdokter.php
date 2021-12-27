<?php
  session_start();

	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");

    $page = isset($_GET['page']) ? $_GET['page']: false;
	$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id']: false;
    
	
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $resep_id = isset($_GET['resep_id']) ? $_GET['resep_id'] : false;
    
    $keterangan_gambar = "";
    $gambar_resep = "";

    if($resep_id){
		$query = mysqli_query($koneksi, "SELECT * FROM resep WHERE resep_id='$resep_id'");
		$row = mysqli_fetch_assoc($query);

		$gambar_resep = $row['gambar_resep'];
		
		$keterangan_gambar = "(Klik pilih gambar jika ingin mengganti gambar)";
		$gambar_resep = "<img src='".BASE_URL."frontend/images/resep/$gambar_resep' style='width: 200px;vertical-align: middle;' />";
	}

    if($user_id == false){
		$_SESSION["proses_resep"] = true;
		
		header("location:".BASE_URL."login.html");
		exit;
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
                <img src="frontend/images/logo.png" alt="Logo Apotek" />
            </a>
            <button class="navbar-toggler navbar-toogler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-md-2">
                        <a href="index.html" class="nav-link ">Beranda</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="berita_kesehatan.html" class="nav-link">Berita Kesehatan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="resepdokter.html" class="nav-link dropdown-toggle active" id="navbardrop"
                            data-bs-toggle="dropdown">
                            Resep Dokter
                        </a>
                        <div class="dropdown-menu">
                            <a href="resepdokter.html" class="dropdown-item">Upload Resep Dokter</a>
                        </div>
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
                    <?php
						    if($user_id){
							    echo "<li class='nav-item dropdown'> 
                  <a class='nav-link dropdown-toggle' id='navbardrop' data-bs-toggle='dropdown' >Hi <b>$nama</b></a> 
                  <div class='dropdown-menu'>
								  <a href='".BASE_URL."my_profile.html' class='dropdown-item'>My Profile</a>	
								  <a href='".BASE_URL."logout.php' class='dropdown-item'>Logout</a>	
                  
                  </div>
                  </li>";
						    }else{
							    echo "<form action='login.html' class='form-inline my-2 my-lg-0 d-none d-sm-block'>
                  <button class='btn btn-login btn-navbar-right my-2 my-sm-0 px-4'>Masuk</button>
                  </form>";
						    }
					
					      ?>
                </ul>

                <!--Desktop button-->

            </div>
        </nav>
    </div>
    <!-- akhir Navbar -->

    <main>
        <section class="section-checkout-header"></section>
        <section class="section-checkout-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 pl-lg-0">
                        <div class="card card-details" style="border-radius: 10px; border: 0px none;">
                            <h2>Upload Resep Dokter</h2>
                            <h5>
                                Alamat Pengiriman
                            </h5>
                            <hr>
                            <form action="<?php echo BASE_URL."proses_resep.php?resep_id=$resep_id"; ?>" method="POST"
                                enctype="multipart/form-data">

                                <div class="form-group mb-4">
                                    <label>Nama Penerima </label><input type="text" class="form-control w-75"
                                        name="nama_penebus" />
                                </div>
                                <div class="form-group mb-4">
                                    <label>Nomor Telepon / Handphone </label><input type="text"
                                        class="form-control w-75" name="nomor_penebus" />
                                </div>
                                <div class="form-group mb-4">
                                    <label>Alamat Lengkap Penerima </label><input type="text" class="form-control w-75"
                                        name="alamat_penebus" />
                                </div>
                                <div class="form-resep">
                                    <label>Upload Resep<?php echo $keterangan_gambar;?></label>
                                    <span>
                                        <input type="file" name="file" /><?php echo $gambar_resep; ?>
                                    </span>
                                </div>
                                <div class="form-group mb-4">
                                    <label>Kecamatan </label>
                                    <span>
                                        <select name="kecamatan">
                                            <?php
			                        			$query = mysqli_query($koneksi, "SELECT * FROM kecamatan");
						
			                        			while($row=mysqli_fetch_assoc($query)){
			                        			echo "<option value='$row[kecamatan_id]'>$row[kecamatan] (".rupiah($row["tarif"]).")</option>";
			                        			}
			                        		?>
                                        </select>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-pilih-alamat shadow mb-4">
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <footer class="section-footer mt-5 border-top">
        <div class="container pt-5 pb-5">
            <div class="row justify-conten-center">
                <div class="col-12">
                    <div class="row">
                        <!-- info -->
                        <div class="col-12 col-lg-3">
                            <img src="frontend/images/logo2.png" alt="" />
                        </div>
                        <div class="col-12 col-lg-3">
                            <h5>Info</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Tentang Kami</a></li>
                                <li><a href="#">Kontak</a></li>
                            </ul>
                        </div>
                        <!-- info -->
                        <div class="col-12 col-lg-3">
                            <h5>Perusahaan</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Syarat & Ketentuan</a></li>
                                <li><a href="#">Kebijakan Privasi</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Bantuan Pelayanan</a></li>
                            </ul>
                        </div>
                        <!-- info -->
                        <div class="col-12 col-lg-3">
                            <h5>Kontak</h5>
                            <ul class="list-unstyled">
                                <li><a href="#">Jl. Kelapa Dua no.42</a></li>
                                <li><a href="#">Depok, Jawa Barat</a></li>
                                <li><a href="#">Indonesia</a></li>
                                <li><a href="#">(021)0707070707</a></li>
                                <li><a href="#">Contact@pharmacy.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row border-top justify-content-center alignt-items-center pt-4">
                <div class="col-auto text-gray-500 font-weight-light mb-0" style="color: #fff">
                    Copyright 2021 Harry. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    <script src="frontend/libraries/jquery/jquery-3.6.0.min.js"></script>
    <script src="frontend/libraries/boostrap/js/bootstrap.js"></script>
    <script src="frontend/libraries/retina/retina.min.js"></script>
</body>

</html>