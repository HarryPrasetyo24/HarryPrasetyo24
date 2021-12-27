<?php
 session_start();

	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");

    
    $page = isset($_GET['page']) ? $_GET['page']: false;

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : false;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;

	if($user_id){
		$module = isset($_GET['module']) ? $_GET['module'] : false;
		$action = isset($_GET['action']) ? $_GET['action'] : false;
		$mode = isset($_GET['mode']) ? $_GET['mode'] : false;
	}else{
		header("location: ".BASE_URL."login.html");
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
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
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
        <div class="container" id="bg-page-profile">
            <div class="row">


                <div class="col-sm-3 col-md-3 col-lg-3" id="menu-profile">

                    <ul>
                        <?php 
				        if($level == "admin"){ 
			
			            ?>

                        <li>
                            <a <?php if($module == "kategori"){ echo "class='active'"; } ?>
                                href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=kategori&action=list";?>">Kategori</a>
                        </li>
                        <li>
                            <a <?php if($module == "barang"){ echo "class='active'"; } ?>
                                href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=barang&action=list";?>">Produk</a>
                        </li>
                        <li>
                            <a <?php if($module == "kecamatan"){ echo "class='active'"; } ?>
                                href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=kecamatan&action=list";?>">Kecamatan</a>
                        </li>
                        <li>
                            <a <?php if($module == "user"){ echo "class='active'"; } ?>
                                href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=user&action=list";?>">User</a>
                        </li>
                        <li>
                            <a <?php if($module == "berita"){ echo "class='active'"; } ?>
                                href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=berita&action=list";?>">Berita</a>
                        </li>
                        <?php
				        }
			            ?>
                        <li>
                            <a <?php if($module == "pesanan"){ echo "class='active'"; } ?>
                                href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=pesanan&action=list";?>">Pesanan</a>
                        </li>
                        <li>
                            <a <?php if($module == "resep"){ echo "class='active'"; } ?>
                                href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=resep&action=list";?>">Resep
                                Saya</a>
                        </li>

                    </ul>


                </div>


                <div class="col-sm-9 col-md-9 col-lg-9" id="profile-content">
                    <?php
			
			                $file ="module/$module/$action.php";
			                if(file_exists($file)){
				            include_once($file);
			                }else{
				            echo"<h3>Maaf, halaman tersebut tidak ditemukan</h3>";
			                }
			
		                    ?>

                </div>


            </div>
        </div>
    </main>

    <footer>
        <div class="container-fluid regter pt-5">
            <div class="row border-top justify-content-center alignt-items-center pt-4">
                <div class="col-auto text-gray-500 font-weight-light mb-0" style="color: #07284e">
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