<?php 
// var_dump($data['versi_borang']);
// exit();
?>
<script type="text/javascript" language="javascript" >
  $(document).ready(function() {
    // $('#lookup').DataTable({
    //   responsive: true,
    //   order: [[ 0, "desc" ]]
    // });
    // $('#lookup1').DataTable({
    //   responsive: true,
    //   orderCellsTop: true
    // });
  });
</script>

<div class="box box-primary">

    <div class="box-body">

    <div class="form-group">

    </div>

    <h4><strong><font color=blue>DATA PRESTASI</font></strong></h4>
    
    <form method="get" action="<?php echo base_url('laporan/filter'); ?>">
      
        <label for="tahun_ajar">Tahun Ajar</label><br>
          <input value="<?php echo $this->input->get('tahun_ajar_awal'); ?>" required type="number" min="2000" max="2900" class="" id="tahun_ajar_awal" placeholder="Isi Tahun Ajar" name="tahun_ajar_awal" style="height: 34px; background: #f2f2f2; border: none;">
          /
        <input readonly value="<?php echo $this->input->get('tahun_ajar_akhir'); ?>" required type="number" min="2000" max="2900" class="" id="tahun_ajar_akhir" placeholder="Isi Tahun Ajar" name="tahun_ajar_akhir" style="height: 34px; background: #f2f2f2; border: none;">

        <select id="nokegiatan" name="cs" style="height: 34px; background: #f2f2f2; border: none;">
          <option value="">Semua Semester</option>
          <option value="o" <?php echo $this->input->get('cs') == 'o' ? 'selected' : null; ?>>Gasal</option>
          <option value="e" <?php echo $this->input->get('cs') == 'e' ? 'selected' : null; ?>>Genap</option>
        </select>
        <!-- <select name="fk" style="height: 34px; background: #f2f2f2; border: none;">
          <option value="">Semua Fakultas</option>
          <option value="1" <?php echo $this->input->get('fk') == '1' ? 'selected' : null; ?>>FTI</option>
          <option value="2" <?php echo $this->input->get('fk') == '2' ? 'selected' : null; ?>>ASTRI</option>
          <option value="3" <?php echo $this->input->get('fk') == '3' ? 'selected' : null; ?>>FEB</option>
          <option value="4" <?php echo $this->input->get('fk') == '4' ? 'selected' : null; ?>>FISIP</option>
          <option value="5" <?php echo $this->input->get('fk') == '5' ? 'selected' : null; ?>>FT</option>
          <option value="6" <?php echo $this->input->get('fk') == '6' ? 'selected' : null; ?>>PASCASARJANA</option>
          <option value="7" <?php echo $this->input->get('fk') == '7' ? 'selected' : null; ?>>FIKOM</option>
        </select> -->

      <input type="submit" class="btn btn-default" value="Filter">
    </form> 

    <!-- <a href="<?php //echo base_url('Laporan/export'); ?>" class="btn btn-success pull-right"><i class="fa fa-file-excel-o"></i> Ekspor Excel</a> -->
    <?php
    $tahun_ajar_awal = $this->input->get('tahun_ajar_awal');
    $tahun_ajar_akhir = $this->input->get('tahun_ajar_akhir');
    $cs = $this->input->get('cs');
    $fk = $this->input->get('fk');
    ?>
    <a href="<?php echo base_url('laporan/excel?tahun_ajar_awal='.$tahun_ajar_awal.'&tahun_ajar_akhir='.$tahun_ajar_akhir.'&cs='.$cs.'&fk='.$fk); ?>" class="btn btn-danger pull-right" target="_blank" ><i class="fa fa-file-excel-o"></i> Ekspor Excel</a><br/>
    <br/>
    

      <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO TEAM</th>
                    <th>KEGIATAN</th>
                    <th>TEAM</th>
                    <th>JUMLAH ANGGOTA</th>
                    <th>SEMESTER</th>
                    <th>TAHUN AJAR</th>
                    <th>TANGGAL LOMBA</th>
                    <th>TEMPAT LOMBA</th>
                    <th>FOTO</th>
        </tr>
      </thead>

      <tbody>
        <?php
        foreach ($data['team'] as $item) {
          ?>
          <tr>
            <td><?php echo $item->cnoteam; ?></td>
            <td><?php echo $this->db->get_where('mkegiatan', array('cnokegiatan' => $item->cnokegiatan))->row()->cnmkegiatan; ?></td>
            <td><?php echo $item->cnmteam; ?></td>
            <td><?php echo $item->cjmlagt; ?></td>
            <td><?php echo $item->csmt == 'e' ? 'Genap' : 'Gasal'; ?></td>
            <td><?php echo substr($item->cthnajar, 0, 4) . '/' . substr($item->cthnajar, 4, 4); ?></td>
            <td><?php echo $this->pustaka->tanggal_indo($item->dtglawallomba) . ' - ' . $this->pustaka->tanggal_indo($item->dtglakhirlomba); ?></td>
            <td><?php echo $item->ctempatlomba; ?></td>
            <td>
              <?php
              if (file_exists($item->cfoto)) {
                ?>
                <img src="<?php echo base_url($item->cfoto); ?>" width="150" height="150">
                <?php
              }
              ?>
            </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
      
    </table>
  </div><!-- /.boxbody -->
</div><!-- /.box -->

<script type="text/javascript">
// $('form').submit(function () {
//   if ($('#nokegiatan').val() == '' || $('#semester').val() == '') {
//       alert('Belum pilih');
//       return false;
//   }
// });

$('#form_anggota').submit(function () {
  if ($('#dataCnim').val() == '') {
      alert('Belum pilih');
      return false;
  }
});
function hapus(id) {
  if (confirm("Yakin hapus ?")) {
    window.location = "<?php echo base_url('team/aksi_hapus/'); ?>" + id;
  }
}
function hapus_anggota(noteam, nim) {
  if (confirm("Yakin hapus ?")) {
    window.location = "<?php echo base_url('team/aksi_hapus_anggota/'); ?>" + noteam + '/' + nim;
  }
}
$('#tahun_ajar_awal').change(function() {
  $('#tahun_ajar_akhir').val(parseInt($('#tahun_ajar_awal').val()) + 1);
});
$('#tahun_ajar_akhir').change(function() {
  $('#tahun_ajar_awal').val(parseInt($('#tahun_ajar_akhir').val()) - 1);
});
$('#tanggal_lomba_awal').change(function() {
  $('#tanggal_lomba_akhir').val($('#tanggal_lomba_awal').val());
});
$('#nokegiatan').change(function() {
  if ($('#nokegiatan').val() == "") {
    $( "#kegiatan_kategori" ).val( "Pilih Kegiatan" );
    $( "#kegiatan_tingkat" ).val( "Pilih Kegiatan" );
  } else {
    $.post( "<?php echo base_url('team/ambil_detail_kegiatan/'); ?>" + $('#nokegiatan').val(), function( data ) {
      var json = jQuery.parseJSON(data);
      // console.log(json.kategori);
      // console.log(json.tingkat);
      $( "#kegiatan_kategori" ).val( json.kategori );
      $( "#kegiatan_tingkat" ).val( json.tingkat );
    });
  }
});
</script>
