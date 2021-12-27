<?php
	
	$resep_id= $_GET["resep_id"];
	
	$query = mysqli_query($koneksi, "SELECT resep.nama_penebus, resep.nomor_penebus, resep.alamat_penebus, resep.harga, resep.tanggal_penebusan, user.nama, kecamatan.kecamatan, kecamatan.tarif FROM resep JOIN user ON resep.user_id=user.user_id JOIN kecamatan ON kecamatan.kecamatan_id=resep.kecamatan_id WHERE resep.resep_id='$resep_id'");

	$row=mysqli_fetch_assoc($query);
	
	$harga = $row["harga"];
	$tanggal_penebusan = $row["tanggal_penebusan"];
	$nama_penebus = $row["nama_penebus"];
	$nomor_penebus = $row["nomor_penebus"];
	$alamat_penebus = $row["alamat_penebus"];
	$tarif = $row["tarif"];
	$nama = $row["nama"];
	$kecamatan = $row["kecamatan"];

?>

<div id="frame-faktur">

    <h3>
        <center>Detail Resep</center>
    </h3>

    <hr />

    <table>

        <tr>
            <td>Nomor Faktur</td>
            <td>:</td>
            <td><?php echo $resep_id; ?></td>
        </tr>
        <tr>
            <td>Nama Pemesan</td>
            <td>:</td>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <td>Nama Penerima</td>
            <td>:</td>
            <td><?php echo $nama_penebus; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo $alamat_penebus; ?></td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td><?php echo $nomor_penebus; ?></td>
        </tr>
        <tr>
            <td>Tanggal Pemesanan</td>
            <td>:</td>
            <td><?php echo $tanggal_penebusan; ?></td>
        </tr>
    </table>
</div>

<table class="table-list">

    <tr class="baris-title">
        <th class="no">No</th>
        <th class="kiri">Gambar Resep</th>
        <th class="tengah">Harga Satuan</th>
        <th class="tengah">Total</th>
    </tr>

    <?php 
		
			$queryDetail=mysqli_query($koneksi, "SELECT resep_detail.* FROM resep_detail WHERE resep_detail.resep_id='$resep_id'");
			
			$no = 1;
			$subtotal = 0;
			while($rowDetail=mysqli_fetch_Assoc($queryDetail)){
				
            $gambar_resep = $rowDetail["gambar_resep"];
			$total = $rowDetail["harga"];
			$subtotal = $subtotal + $total;
			
				echo "<tr>
						<td class='no'>$no</td>
                        <td class='kiri'><img src='".BASE_URL."frontend/images/resep/$gambar_resep' height='100px' /></td>
						<td class='tengah'>".rupiah($rowDetail["harga"])."</td>
						<td class='tengah'>".rupiah($total)."</td>
					  </tr>";
					  
				$no++;
			}
			
			$subtotal = $subtotal + $tarif;
		?>

    <tr>
        <td class="kanan" colspan="3">Biaya Pengiriman</td>
        <td class="tengah"><?php echo rupiah($tarif); ?></td>
    </tr>

    <tr>
        <td class="kanan" colspan="3"><b>Sub total</b></td>
        <td class="tengah"><b><?php echo rupiah($subtotal); ?></b></td>
    </tr>

</table>

<div id="frame-keterangan-pembayaran">
    <p>Silahkan Lakukan pembayaran ke BANK BCA<br />
        Nomor Rekening : 475011111 (A/N Harry Prasetyo).<br />
        Setelah melakukan pembayaran silahkan lakukan konfirmasi pembayaran
        <a
            href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=resep&action=konfirmasi_pem_resep&resep_id=$resep_id"?>">Disini</a>.
    </p>

</div>