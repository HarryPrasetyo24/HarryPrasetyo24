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
                        <a href="berita_kesehatan.html" class="nav-link ">Berita Kesehatan</a>
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
                        <a href="produk.html" class="nav-link dropdown-toggle active" id="navbardrop"
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
        <div class="container" id="bg-page-product">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3" id="kiri">
                    <?php
	
		                echo kategori($kategori_id);
	
	                ?>
                </div>


                <div class="col-sm-9 col-md-9 col-lg-9" id="section-product">



                    <div id="frame-barang">

                        <ul>
                            <?php

                            $pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	                        $data_per_halaman = 9;
	                        $mulai_dari = ($pagination-1) * $data_per_halaman;
                            
                            $url = "produk.php?kategori_id=$kategori_id";
                            
				
				            if($kategori_id){
					           $kategori_id = "AND barang.kategori_id='$kategori_id'";
				            }
					            $query =mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id WHERE barang.status='on' $kategori_id ORDER BY barang_id DESC LIMIT $mulai_dari, $data_per_halaman");
				
				            $no=1;
				            while($row=mysqli_fetch_assoc($query)){

                                
                            $url = "produk.php?kategori_id=$row[kategori_id]";
                            
					        $kategori = strtolower($row["kategori"]);
					        $barang = strtolower($row["nama_barang"]);
					        $barang = str_replace(" ","-",$barang);
					
					        $style=false;
					        if($no == 3){
						    $style="style='margin-right:0px'";
						    $no=0;
					        }
					
					
					        echo "<li $style>

                            
							<a href='".BASE_URL."details.php?barang_id=$row[barang_id]''>
                            <img src='".BASE_URL."frontend/images/barang/$row[gambar]' />
							</a>
                            
							<div class='nama-produk'>
                            <p><a href='".BASE_URL."details.php?barang_id=$row[barang_id]'>$row[nama_barang]</a></p>
							<p class='harga-produk'>".rupiah($row['harga'])."</p>
								<span>Stok : $row[stok]</span>
							</div>
                            
							<div class='button-add-cart'>
								<a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+ add to cart</a>
							</div>";
							
						    $no++;
				            }
			
			                ?>

                        </ul>

                    </div>

                </div>
            </div>
        </div>

        <section>
            <?php


                $queryHitungKategori = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id WHERE barang.status='on' $kategori_id");
		        $total_data = mysqli_num_rows($queryHitungKategori);
		        $total_halaman = ceil($total_data / $data_per_halaman);

		        $batasPosisiNomor = 2;
		        $batasJumlahHalaman = 5;
		        $mulaiPagination = 1;
		        $batasAkhirPagination = $total_halaman;

		        echo "
		         <nav aria-label='Page navigation example'>
		         <ul class='pagination justify-content-center mt-4'>";

		         if($pagination > 1){
		        	 $prev = $pagination - 1;
		        	 echo "<li class='page-item'><a class='page-link' href='".BASE_URL."$url&pagination=$prev'>Previous</a></li>";
		        	}

		        	if($total_halaman >= $batasJumlahHalaman){

		        		if($pagination > $batasPosisiNomor){
		        			$mulaiPagination = $pagination - ($batasPosisiNomor - 1);
		        		}
				
		        		$batasAkhirPagination = ($mulaiPagination - 1) + $batasJumlahHalaman;
		        		if($batasAkhirPagination >= $total_halaman){
		        			$batasAkhirPagination = $total_halaman;
		        		}
		        	}

		        	for($i = $mulaiPagination; $i <= $batasAkhirPagination; $i++){
		        		if($pagination == $i){
		        		echo "<li class='page-item active'><a class='page-link' href='".BASE_URL."$url&pagination=$i'>$i</a></li>";
                        
		        	}else{
		        		echo "<li class='page-item'><a class='page-link' href='".BASE_URL."$url&pagination=$i'>$i</a></li>";
                    
		        	}
		        	}
		        	if($pagination < $total_halaman){
		        	 $next = $pagination + 1;
		        	 echo "<li class='page-item'><a class='page-link' href='".BASE_URL."$url&pagination=$next'>Next</a></li>";
		        	}
		        echo "</ul>
		        </nav>";
                ?>
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