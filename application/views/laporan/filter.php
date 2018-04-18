<?php 
// var_dump($data['versi_borang']);
// exit();
?>
<script type="text/javascript" language="javascript" >
  $(document).ready(function() {
    $('#lookup').DataTable({
      responsive: true,
      order: [[ 0, "desc" ]]
    });
    // $('#lookup1').DataTable({
    //   responsive: true,
    //   orderCellsTop: true
    // });
  });
</script>

<div class="box box-primary">

    <div class="box-body">

    <div class="form-group">

    <?php
    if ($data['team_id'] != null) {
      $action = base_url('team/aksi_ubah/');
      $cnoteam = $data['team_id']->cnoteam;
      $cnmteam = $data['team_id']->cnmteam;
      $cnokegiatan = $data['team_id']->cnokegiatan;
      $cjmlagt = $data['team_id']->cjmlagt;
      $csmt = $data['team_id']->csmt;
      $cthnajar = $data['team_id']->cthnajar;
      $dtglawallomba = $data['team_id']->dtglawallomba;
      $dtglakhirlomba = $data['team_id']->dtglakhirlomba;
      $ctempatlomba = $data['team_id']->ctempatlomba;
      $cfoto = $data['team_id']->cfoto;
    } else {
      $action = base_url('team/aksi_tambah/');
      $cnoteam = 'T' . str_pad($data['ai'],4,"0",STR_PAD_LEFT);
      $cnmteam = null;
      $cnokegiatan = null;
      $cjmlagt = null;
      $csmt = null;
      $cthnajar = null;
      $dtglawallomba = null;
      $dtglakhirlomba = null;
      $ctempatlomba = null;
      $cfoto = null;
    }
    ?>


    </div>

    <h4><strong><font color=blue>DATA PRESTASI</font></strong></h4>
    
    <form method="get" action="<?php echo base_url('laporan/filter'); ?>">
      <?php 

      ?>
        <label for="tahun_ajar">Tahun Ajar</label><br>
          <input value="<?php echo $this->input->get('tahun_ajar_awal')  ?>" required type="number" min="2017" max="2900" class="" id="tahun_ajar_awal" placeholder="Isi Tahun Ajar" name="tahun_ajar_awal" style="height: 34px; background: #f2f2f2; border: none;">
          /
        <input readonly value="<?php echo $this->input->get('tahun_ajar_akhir')  ?>" required type="number" min="2018" max="2900" class="" id="tahun_ajar_akhir" placeholder="Isi Tahun Ajar" name="tahun_ajar_akhir" style="height: 34px; background: #f2f2f2; border: none;">

        <select id="nokegiatan" name="cs" style="height: 34px; background: #f2f2f2; border: none;">
          <option value="">semester</option>
          <option <?php echo $this->input->get('cs') == 'o' ? 'selected' : null; ?> value="o">Gasal</option>
          <option <?php echo $this->input->get('cs') == 'e' ? 'selected' : null; ?> value="e">Genap</option>
        </select>

        <select name="fk" style="height: 34px; background: #f2f2f2; border: none;">
          <option value="">fakultas</option>
          <option value="1">FTI</option>
          <option value="2">ASTRI</option>
          <option value="3">FEB</option>
          <option value="4">FISIP</option>
          <option value="5">FT</option>
          <option value="6">PASCASARJANA</option>
          <option value="7">FIKOM</option>
        </select>
      
      <input type="submit" class="btn btn-default" value="Filter">
    </form> 

    <?php //foreach($data['team'] as $t){ 
      //if(count($t->cthnajar) > 0){
    ?>

    <a href="<?php echo base_url('Laporan/pdf_filter/'); ?>" class="btn btn-danger pull-right" target="_blank" ><i class="fa fa-file-pdf-o"></i> Ekspor PDF</a><br/>
    <br/>

    <?php //}} ?>

      


    

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
            <th><?php echo $item->cnoteam; ?></th>
            <th><?php echo $this->db->get_where('mkegiatan', array('cnokegiatan' => $item->cnokegiatan))->row()->cnmkegiatan; ?></th>
            <th><?php echo $item->cnmteam; ?></th>
            <th><?php echo $item->cjmlagt; ?></th>
            <th><?php echo $item->csmt == 'e' ? 'Genap' : 'Gasal'; ?></th>
            <th><?php echo substr($item->cthnajar, 0, 4) . '/' . substr($item->cthnajar, 4, 4); ?></th>
            <th><?php echo $this->pustaka->tanggal_indo($item->dtglawallomba) . ' - ' . $this->pustaka->tanggal_indo($item->dtglakhirlomba); ?></th>
            <th><?php echo $item->ctempatlomba; ?></th>
            <th>
              <?php
              if (file_exists($item->cfoto)) {
                ?>
                <img src="<?php echo base_url($item->cfoto); ?>" width="150" height="150">
                <?php
              }
              ?>
            </th>
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
