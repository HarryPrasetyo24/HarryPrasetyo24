<?php

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
    <section class="section-register-nav">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <a href="index.html" class="register-brand">
                        <img src="frontend/images/logo.png" alt="Logo PHARMACY" />
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- akhir Navbar -->

    <main>
        <section class="section-name-daftarsekarang">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <h3>Daftar Sekarang</h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-register-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-6 col-lg-6 register-content">
                        <form action="proses_register.php" method="POST">

                            <?php 
                        
                          $notif = isset($_GET['notif'])? $_GET['notif'] : false;
			                    $nama_lengkap = isset($_GET['nama_lengkap'])? $_GET['nama_lengkap'] : false;
			                    $email = isset($_GET['email'])? $_GET['email'] : false;
			                    $phone = isset($_GET['phone'])? $_GET['phone'] : false;

                          if($notif == "require"){
				                     echo "<div class='notif mb-4'>Maaf, anda harus melengkapi form dibawah ini </div>";
                        }else if($notif == "password"){
			                      echo "<div class='notif mb-4>Maaf, password yang anda masukkan harus sama </div>";
		                  	}else if($notif == "email"){
				                    echo "<div class='notif mb-4'>Maaf, email yang anda masukkan sudah terdaftar </div>";
			                  }
                        
                        ?>
                            <div class="form-group mb-4">
                                <label>Nama Lengkap </label><input type="text" class="form-control w-75"
                                    name="nama_lengkap" value="<?php echo $nama_lengkap;?>" />
                            </div>
                            <div class="form-group mb-4">
                                <label>Email</label>
                                <input type="email" class="form-control w-75" aria-describedby="emailHelp" name="email"
                                    value="<?php echo $email;?>" />
                            </div>
                            <div class="form-group mb-4">
                                <label>Nomor Telepon / Handphone </label><input type="text" class="form-control w-75"
                                    name="phone" value="<?php echo $phone;?>" />
                            </div>

                            <div class="form-group mb-4">
                                <label>Password</label>
                                <input type="password" class="form-control w-75" name="password" />
                            </div>
                            <div class="form-group mb-4">
                                <label>Re-Password</label>
                                <input type="password" class="form-control w-75" name="re_password" />
                            </div>
                            <button type="submit" class="btn btn-signup shadow w-75 mt-2">
                                Daftar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
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