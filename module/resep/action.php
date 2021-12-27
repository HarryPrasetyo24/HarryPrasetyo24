<?php 

    include("../../frontend/function/koneksi.php");   
    include("../../frontend/function/helper.php");   
	
	admin_only("resep", $level);
	
	session_start();
	
	$resep_id = $_GET['resep_id'];
	$button = $_POST['button'];
	$harga = $_POST['harga'];


	
	if($button == "Konfirmasi"){
	
		$user_id = $_SESSION["user_id"];
		$nomor_rekening = $_POST['nomor_rekening'];
		$nama_account = $_POST['nama_account'];
		$tanggal_transfer = $_POST['tanggal_transfer'];
		
		$queryPembayaran =mysqli_query($koneksi, "INSERT INTO konfirmasi_pem_resep (resep_id, nomor_rekening, nama_account, tanggal_transfer)
													VALUES ('$resep_id', '$nomor_rekening', '$nama_account', '$tanggal_transfer')");
		
		if($queryPembayaran){
			mysqli_query($koneksi, "UPDATE resep SET status='1' WHERE resep_id='$resep_id'");
		
		}
		}else if($button == "Edit Status"){
			$status = $_POST["status"];
			
			mysqli_query($koneksi, "UPDATE resep SET status='$status' WHERE resep_id='$resep_id'");
			 mysqli_query($koneksi, "UPDATE resep SET harga='$harga' WHERE resep_id='$resep_id'");
			 mysqli_query($koneksi, "UPDATE resep_detail SET harga='$harga' WHERE resep_id='$resep_id'");
			
			if($status == "2"){
				$query = mysqli_query($koneksi, "SELECT * FROM resep_detail WHERE resep_id='$resep_id'");
				
			}
		}
		
		header("location:".BASE_URL."my_profile.php?page=my_profile&module=resep&action=list");