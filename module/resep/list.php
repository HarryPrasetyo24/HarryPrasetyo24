                        <?php 
				        if($level == "admin"){ 
			
			            ?>
                        <div id="frame-tambah">
                            <a href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=resep&action=form"; ?>"
                                class="tombol-action">Daftar Konfirmasi</a>
                        </div>
                        <?php
				        }
			            ?>

                        <?php

	$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($pagination-1) * $data_per_halaman;
	$url = "my_profile.php?page=my_profile&module=resep&action=list";

	if($level == "admin"){
	$queryResep = mysqli_query($koneksi, "SELECT resep.*, user.nama FROM resep JOIN user ON resep.user_id=user.user_id ORDER BY resep.tanggal_penebusan DESC LIMIT $mulai_dari, $data_per_halaman");
	}else{
	$queryResep = mysqli_query($koneksi, "SELECT resep.*, user.nama FROM resep JOIN user ON resep.user_id=user.user_id WHERE resep.user_id='$user_id' ORDER BY resep.tanggal_penebusan DESC LIMIT $mulai_dari, $data_per_halaman");
	}
		
	if(mysqli_num_rows($queryResep) == 0){
		echo "<h3>Saat ini belum ada data Resep</h3>";
	}else{
	
		echo "<table class='table-list'>
				<tr class='baris-title'>
					<th class='kiri'>Nomor Resep</th>
					<th class='kiri'>Status</th>
					<th class='kiri'>Nama</th>
					<th class='tengah'>Action</th>
				</tr>";
		
		$adminButton = "";
		while($row=mysqli_fetch_assoc($queryResep)){
			if($level == "admin"){
				$adminButton = "<a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=resep&action=status&resep_id=$row[resep_id]'>Update Status</a>";
			}
			
			$status = $row['status'];
			echo "<tr>
					<td class='kiri'>$row[resep_id]</td>
					<td class='kiri'>$arrayStatusPesanan[$status]</td>
					<td class='kiri'>$row[nama]</td>
					<td class='tengah'>
						<a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=resep&action=detail&resep_id=$row[resep_id]'>Detail resep </a>
						$adminButton
					</td>
				</tr>";
		}
		
		echo "</table>";

		$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM resep ");
		pagination($queryHitungKategori, $data_per_halaman, $pagination, "my_profile.php?page=my_profile&module=resep&action=list");
		
	}
?>