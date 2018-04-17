<!DOCTYPE html>
<html>
<head>
	<title>Proposal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Font Awesome -->
</head>
<body style="margin: 0 20px 20px 20px; padding: 10px;">
	<table>
		<tr>
			<td ><img src="<?php echo base_url("assets/logo.jpg"); ?>" style="height: 80px; width: 90px; margin-right: 10px;"></td>
			<td >
				<center><b>KEMENTRIAN RISET, TEKNOLOGI DAN PENDIDIKAN TINGGI</b></center>
				<center><b>UNIVERSITAS BUDI LUHUR</b></center>
				<center>Jl. Ciledug Raya, Petukangan Utara, Jakarta Selatan, 12260. DKI Jakarta, Indonesia. Telp: 021-585 3753 Fax: 021-585 3752.</center>
				<br>
				<br>
			</td>
			<td></td>
		</tr>
	</table>
<div class="bb" style="border: 2px solid black"></div>
<br>
	
<p>berikut ini merupakan data ....:</p>
<div>
	<table class="table table-bordered">
		<tbody>
			<tr>
				<th>no</th>
				<th>Kategori</th>
				<th>Kegiatan</th>
				<th>Tingkat</th>
				<th>Tempat</th>
				<th><center>Mahasiswa Kejuaraan</center></th>
				<th>Prestasi</th>
				<th>Foto</th>
			</tr>

			<?php 
				$no = 1;
				// $kategori = $this->db->get_where('mkategori', array(''))->result();
				$kegiatan = $this->db->get('mkegiatan')->row();

				$ta1 = date('Y') - 1;
				$ta2 = date('Y');
				$tahun = $ta1.$ta2;
				// $team = $this->db->get('tagtteam')->result();
				$teamm = $this->db->get_where('mteammhs', array('cnokegiatan' => $kegiatan->cnokegiatan, 'cthnajar' => $tahun))->result();
				// $kegiatan = $this->db->get_where('mkegiatan', array(''))->result();

				// $team = $this->db->get('mteammhs')->result();
				foreach($data['team'] as $tg):
					$kegiatan = $this->db->get_where('mkegiatan', array('cnokegiatan' => $tg->cnokegiatan))->row();
					$kategori = $this->db->get_where('mkategori', array('cnokategori' => $kegiatan->cnokategori))->row();
				$tgt = $this->db->get_where('tagtteam', array('cnoteam' => $tg->cnoteam))->row();	
			 ?>

			 <tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $kategori->cnmkategori; ?></td>
				<td><?php echo $kegiatan->cnmkegiatan; ?></td>
				<td><?php echo $kegiatan->ctingkat; ?></td>
				<td><?php echo $tg->ctempatlomba; ?></td>
				<td>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th>Nim</th>
								<th>Nama</th>
								<!-- <th>Fakultas</th> -->
								<th>Bukti</th>
							</tr>
							<?php 
								$mhs = $this->db->get_where('tagtteam', array('cnoteam' => $tg->cnoteam))->result();
								foreach($mhs as $m){

									$nama = $this->db->get_where('mmhs', array('cnim' => $m->cnim))->row();

							?>
							<tr>
								<td><?php echo $m->cnim; ?></td>
								<td><?php echo $nama->cnama; ?></td>
								<!-- <td> - </td> -->
								<td><img src="<?php echo $tgt->cbukti; ?>" style="height: 50px; width: 50px;"></td>
							</tr>
							<?php } ?>
						</tr>
						</tbody>
					</table>
				</td>
				<td><?php echo $tgt->cprestasi; ?></td>
				<td><img src="<?php echo $tg->cfoto; ?>" style="height: 50px; width: 50px;"></td>
			</tr>
			<?php 

				endforeach;
			?>

		</tbody>
	</table>
</div>

</body>
</html>