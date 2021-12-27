<?php
  session_start();

	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");

    $page = isset($_GET['page']) ? $_GET['page']: false;
	$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id']: false;
	
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;
    $keranjang = isset($_SESSION['keranjang']) ? $_SESSION['keranjang'] : array();
    $totalBarang = count($keranjang);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Apotek Sumber Sehat</title>
    <link rel="stylesheet" href="frontend/libraries/boostrap/css/bootstrap.css" />
    <link rel="stylesheet" href="frontend/libraries/xzoom/xzoom.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Assistant:wght@200;300;400;500;600;700;800&
    family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="frontend/styles/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
                        <a href="index.html" class="nav-link active">Beranda</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="berita_kesehatan.html" class="nav-link">Berita Kesehatan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="resepdokter.html" class="nav-link dropdown-toggle" id="navbardrop"
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
                    <li>
                        <a href="<?php echo BASE_URL. "keranjang.html"; ?>" id="button-keranjang">
                            <img src="<?php echo BASE_URL."frontend/images/icon-cart.png";?>" />
                            <?php
							if($totalBarang != 0){
								echo "<span class='total-barang'>$totalBarang</span>";
							}
						?>
                        </a>
                    </li>
                    <?php
						    if($user_id){
							    echo "
                                <li class='nav-item dropdown'> 
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
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                    <div class="col pl-0">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Beranda</li>
                                <li class="breadcrumb-item">Detail</li>
                                <?php
                                $barang_id = $_GET['barang_id'];
		
		                            $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id' AND status ='on'");
		                            $row = mysqli_fetch_assoc($query);


                                echo "<li class='breadcrumb-item active'>$row[nama_barang]</li>";
                                
                                ?>

                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 pl-lg-0">
                        <div class="card card-details">
                            <div class="gallery">
                                <?php 
                                 echo "   
                                <div class='xzoom-container'>
                                    
                                   
                                    <img src='".BASE_URL."frontend/images/barang/$row[gambar]' class='xzoom' id='xzoom-default'
                                        xoriginal='".BASE_URL."frontend/images/barang/$row[gambar]' />
                                        
                                  </div>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card card-details card-right shadow">
                            <?php
                          echo "
                            <h2>$row[nama_barang]</h2>
                            <h3>Stok : $row[stok]</h3>
                            <h3>".rupiah($row['harga'])."</h3>

                            <div class='beli-barang-button'>
                           <a class='btn btn-beli-barang' href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+ add to cart</a>
                            </div>
                            ";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-deskripsi" id="deskripsi">
            <div class="container">
                <div class="row">
                    <div class="col text-start deskripsi border">
                        <h2>Deskripsi Produk</h2>
                        <hr />
                        <?php
                        echo"
                        <p>
                            $row[spesifikasi]
                        </p>";
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-related-product" id="productTerkait">
            <div class="container">
                <div class="row">
                    <div class="col text-start section-related-product-header">
                        <h2>Produk Lainnya</h2>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-related-product-content" id="popularContent">
            <div class="container">
                <div class="section-related-product row justify-content-center">
                    <!-- Barang -->

                    <?php 
                                    if($kategori_id){
					                    $kategori_id = "AND barang.kategori_id='$kategori_id'";
				                    }
                                    $query = mysqli_query($koneksi, "SELECT * FROM barang WHERE status='on' ORDER BY rand() LIMIT 4");
                                    $no=1;
				                    while($row=mysqli_fetch_assoc($query)){
					
                  
                                      echo"<div class='col-sm-6 col-md-6 col-lg-3'>
                                      <div class='card-related text-center d-flex flex-column shadow-sm'>
                                      <img class='gambar-terkait' src='".BASE_URL."frontend/images/barang/$row[gambar]'>
                                      <div class='nama-barang'>
                                      $row[nama_barang]
                                      </div>
                                      <div class='harga-barang'>".rupiah($row['harga'])."</div>
                                      <div class='barang-button mt-auto'>
                                      <a href='".BASE_URL."details.php?barang_id=$row[barang_id]' class='btn btn-lihat-detail px-4'>
                                      Lihat Detail
                                      </a>
                                      </div>
                                      </div>
                                      </div>";
                                      $no++;
				                      }
                                    
                                    ?>

                </div>
            </div>
        </section>
    </main>

    <footer class="section-footer mt-5 mb-4 border-top">
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
                                <li><a href="panduan.php">Bantuan Pelayanan</a></li>
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
                <div class="col-auto text-gray-500 font-weight-light" style="color: #fff">
                    Copyright 2021 Harry. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    <script src="frontend/libraries/jquery/jquery-3.6.0.min.js"></script>
    <script src="frontend/libraries/boostrap/js/bootstrap.js"></script>
    <script src="frontend/libraries/retina/retina.min.js"></script>
    <script src="frontend/libraries/xzoom/xzoom.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".xzoom, .xzoom-gallery").xzoom({
            zoomWidth: 500,
            title: false,
            tint: "#07284e",
            Xoffset: 15,
        });
    });
    </script>
</body>

</html>