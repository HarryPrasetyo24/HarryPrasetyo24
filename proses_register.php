<?php

	include_once("frontend/function/helper.php");
	include_once("frontend/function/koneksi.php");
    
    $level = "customer";
	$nama_lengkap = $_POST['nama_lengkap'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password =$_POST['password'];
	$re_password = $_POST['re_password'];

    unset($_POST['password']);
	unset($_POST['re_password']);
    $dataForm = http_build_query($_POST);

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email'");

    if(empty($nama_lengkap) ||empty($email) || empty($phone)  || empty($password)){
		header("location: ".BASE_URL. "register.php?notif=require&$dataForm");
    }elseif($password != $re_password){
		header("location: ".BASE_URL. "register.php?notif=password&$dataForm");
	}elseif(mysqli_num_rows($query) == 1){
		header("location: ".BASE_URL. "register.php?notif=email&$dataForm");
	}else{
            $password = md5($password);
            mysqli_query($koneksi, "INSERT INTO user (level, nama, email,  phone, password) 
									VALUES ('$level', '$nama_lengkap','$email', '$phone', '$password')");
        header("location: ".BASE_URL. "login.php");
    }

?>