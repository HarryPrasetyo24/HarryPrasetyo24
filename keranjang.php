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
                        <a href="index.html" class="nav-link">Beranda</a>
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
        <section class="section-cart-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 pl-lg-0">
                        <div class="card card-cart" style="border-radius: 10px; border: 0px none;">
                            <h2>Keranjang</h2>

                            <hr>
                            <?php

	                            if($totalBarang == 0){
		                            echo "<h3>Saat ini belum ada data di dalam keranjang belanja anda</h3>";
	                            }else{
	
		                            $no=1;
		
		                            echo "<table class='table-list'>
				                            <tr class='baris-title'>
				                            	<th class='tengah'>No</th>
		                            			<th class='kiri'>Gambar Barang</th>
		                            			<th class='kiri'>Nama Barang</th>
		                            			<th class='tengah'>Qty</th>
		                            			<th class='kiri'>Harga Satuan</th>
		                            			<th class='tengah'>Total</th>
		                            		</tr>";

		                            $subtotal = 0;
		                            foreach($keranjang AS $key => $value){
		                            	$barang_id = $key;
                                    
		                            	$nama_barang = $value["nama_barang"];
		                            	$quantity = $value["quantity"];
		                            	$gambar = $value["gambar"];
		                            	$harga = $value["harga"];
                                    
		                            	$total = $quantity * $harga;
		                            	$subtotal = $subtotal + $total;
                                    
		                            	echo "<tr>
		                            			<td class='tengah'>$no</td>
		                            			<td class='kiri'><img src='".BASE_URL."frontend/images/barang/$gambar' height='100px' /></td>
		                            			<td class='kiri'>$nama_barang</td>
		                            			<td class='tengah' ><input type ='text' name='$barang_id' value='$quantity' class='update-quantity' /></td>
		                            			<td class='kiri'>".rupiah($harga)."</td>
		                            			<td class='tengah hapus_item'>".rupiah($total)."<a href='".BASE_URL."hapus_item.php?barang_id=$barang_id'><img src='".BASE_URL."frontend/images/delete.png'</a></td>
		                            		</tr>";
                                    
		                            	$no++;
                                    
		                            }
                                
		                            echo "<tr>
                                
		                            		<td colspan='5' class='kanan'><b>Sub Total</b></td>
		                            		<td class='tengah'><b>".rupiah($subtotal)."</b></td>
		                            	  </tr>";
                                
		                            echo "</table>";
                                    
		
                            		echo "<div id='frame-button-keranjang'>
				                            <a class='btn btn-pilih-barang shadow mb-4'id='lanjut-belanja' href='".BASE_URL."produk.html'>< Lanjut Belanja</a>
                            				<a  class='btn btn-pilih-barang shadow mb-4'id='lanjut-pemesanan' href='".BASE_URL."checkout.html'>Lanjut Pemesanan ></a>
			                            </div>";
                                
                            	}
	
                            ?>

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
    <script>
    $(".update-quantity").on("input", function(e) {
        var barang_id = $(this).attr("name");
        var value = $(this).val();

        $.ajax({
                method: "POST",
                url: "update_keranjang.php",
                data: "barang_id=" + barang_id + "&value=" + value
            })
            .done(function(data) {
                var json = $.parseJSON(data);
                if (json.status == true) {
                    location.reload();
                } else {
                    alert(json.pesan);
                    location.reload();
                }
            });

    });
    </script>
</body>

</html>