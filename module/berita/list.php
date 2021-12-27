<?php 
	$search = isset($_GET["search"]) ? $_GET["search"] : false;

	$where = "";
	$search_url = "";
	if($search){
		$search_url = "&search=$search";
		$where = "WHERE berita.berita LIKE '%$search%'";
	}
?>


<div class="search-section">
    <form action="<?php echo BASE_URL."my_profile.php"; ?>" method="GET">
        <input type="hidden" name="page" value="<?php echo $_GET["page"]; ?>">
        <input type="hidden" name="module" value="<?php echo $_GET["module"]; ?>">
        <input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>">
        <input class="search-engine" type="text" name="search" value="<?php echo $search; ?>">
        <input class="search-button" type="submit" value="search">
    </form>
</div>

<div id="frame-tambah">
    <a class="tombol-action" href="<?php echo BASE_URL."my_profile.php?page=my_profile&module=berita&action=form"; ?>">+
        Tambah Berita</a>
</div>

<?php


    $pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
	$data_per_halaman = 10;
	$mulai_dari = ($pagination-1) * $data_per_halaman;
	$url = "my_profile.php?page=my_profile&module=berita&action=list";

    $no=1;
        
    $queryBerita = mysqli_query($koneksi, "SELECT * FROM berita $where LIMIT $mulai_dari, $data_per_halaman ");
        
    if(mysqli_num_rows($queryBerita) == 0)
    {
        echo "<h3>Saat ini belum ada berita di dalam database</h3>";
    }
    else
    {
        echo "<table class='table-list'>";
            
            echo "<tr class='baris-title'>
                    <th class='kolom-nomor'>No</th>
                    <th class='kiri'>Berita</th>

                    <th class='tengah'>Status</th>
                    <th class='tengah'>Action</th>
                 </tr>";
    
            while($rowBerita=mysqli_fetch_array($queryBerita))
            {
                echo "<tr>
                        <td class='kolom-nomor'>$no</td>
                        <td>$rowBerita[berita]</td>
                        
                        <td class='tengah'>$rowBerita[status]</td>
                        <td class='tengah'><a class='tombol-action' href='".BASE_URL."my_profile.php?page=my_profile&module=berita&action=form&berita_id=$rowBerita[berita_id]"."'>Edit</a></td>
                     </tr>";
                
                $no++;
            }
            
        echo "</table>";


        $queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM berita $where");
		pagination($queryHitungKategori, $data_per_halaman, $pagination, "my_profile.php?page=my_profile&module=berita&action=list$search_url");
    }
?>