<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php
	$ta1 = date('Y') - 1;
	$ta2 = date('Y');
	$tahun = $ta1 . $ta2;

	echo $tahun;

	?>

	<table border="1">
		<thead>
			<th>no</th>
			<th>kategori </th>
			<th>kegiatan</th>
			<th>Tingkat</th>
			<th>Tempat dan Tanggal</th>
			<th>Mahasiswa Peserta Kejuaraan</th>
			<th>Prestasi yang dicapai</th>
			<th>foto</th>
		</thead>




		<tbody>

			<?php 
				$no = 1;
				// $kategori = $this->db->get_where('mkategori', array(''))->result();
				$kegiatan = $this->db->get('mkegiatan')->row();

				// $team = $this->db->get('tagtteam')->result();
				$teamm = $this->db->get_where('mteammhs', array('cnokegiatan' => $kegiatan->cnokegiatan))->result();
				// $kegiatan = $this->db->get_where('mkegiatan', array(''))->result();

				$team = $this->db->get('mteammhs')->result();
				foreach($team as $tg):
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
					<table border="1">
						<thead>
							<td>Nim</td>
							<td>Nama</td>
							<td>Fakultas</td>
							<td>Bukti</td>
						</thead>
						<thead>
							<?php 
								$mhs = $this->db->get_where('tagtteam', array('cnoteam' => $tg->cnoteam))->result();
								foreach($mhs as $m){

									$nama = $this->db->get_where('mmhs', array('cnim' => $m->cnim))->row();

							?>
							<tr>
								<td><?php echo $m->cnim; ?></td>
								<td><?php echo $nama->cnama; ?></td>
								<td>
									<?php 
										$fak = $m->cnim;
										$cek = substr($fak,2, 1);
										if($cek == '1'){
											echo "FTI";
										}
										elseif($cek == '2'){
											echo "ASTRI";
										}
										elseif($cek == '3'){
											echo "FEB";
										}
										elseif($cek == '4'){
											echo "FISIP";
										}
										elseif($cek == '5'){
											echo "FT";
										}
										elseif($cek == '6'){
											echo "PASCASARJANA";
										}
										elseif($cek == '6'){
											echo "FIKOM";
										}else{
											echo "belum terdaftar";
										}									

									?>
								</td>
								<td><?php echo $m->cprestasi; ?></td>
							</tr>
							<?php } ?>
						</thead>
					</table>
				</td>
				<td><?php echo $tgt->cprestasi; ?></td>
				<td><?php echo $tg->cfoto; ?></td>
			</tr>
			<?php 

				endforeach;
			?>
		</tbody>
	</table>

</body>
</html>