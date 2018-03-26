<?php 
// var_dump($data['versi_borang']);
// exit();
?>
<script type="text/javascript" language="javascript" >
  var dTable;
  $(document).ready(function() {
    dTable = $('#lookup').DataTable({
      responsive: true
    });
  });
</script>

<div class="box box-primary">
  <div class="box-header with-border">
    <h4><strong><font color=blue>KEGIATAN</font></strong></h4>
  </div><!-- /.box-header -->

    <div class="box-body">

    <div class="form-group">
      
    <?php
    if ($data['kegiatan_id'] != null) {
      $action = base_url('kegiatan/aksi_ubah/');
      $cnokegiatan = $data['kegiatan_id']->cnokegiatan;
      $cnmkegiatan = $data['kegiatan_id']->cnmkegiatan;
    } else {
      $action = base_url('kegiatan/aksi_tambah/');
      $cnokegiatan = str_pad($data['ai'],3,"0",STR_PAD_LEFT);
      $cnmkegiatan = null;
    }
    ?>


       <form name="form" id="form" role="form" method="post" action="<?php echo base_url('kegiatan/aksi_tambah/'); ?>">
    <div class="box-body">

    <div class="form-group">
      <label for="nokegiatan">NO Kegiatan</label>
          <input readonly value="<?php echo $cnokegiatan; ?>" required type="text" class="form-control" id="nokegiatan" placeholder="Isi NO Kegiatan" name="nokegiatan">
    </div>

    <div class="form-group">
      <label for="kegiatan">Kegiatan</label>
          <input required type="text" class="form-control" id="kegiatan" placeholder="Isi Kegiatan" name="kegiatan">
    </div>

    <div class="form-group">
      <label for="tingkat">Tingkat</label>
          <select class="form-control select2" name="tingkat">
            <option value="l">Lokal</option>
            <option value="n">Nasional</option>
            <option value="i">Internasional</option>
          </select>
    </div>

    <div class="form-group">
      <label for="nokategori">Kategori</label>
          <select class="form-control select2" name="nokategori">
            <?php
            foreach ($this->db->get('mkategori')->result() as $item) {
              ?>
              <option value="<?php echo $item->cnokategori; ?>"><?php echo $item->cnmkategori; ?></option>
              <?php
            }
            ?>
          </select>
    </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
      <input class="btn btn-success" name="proses" type="submit" value="Simpan Data" />
      <a href="<?php echo base_url('kegiatan'); ?>" class="btn btn-info">Batal</a>
    </div>
  </form>

    </div>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO KEGIATAN</th>
                    <th>KEGIATAN</th>
                    <th>TINGKAT</th>
                    <th>KATEGORI</th>
                    <th>PROSES</th>
        </tr>
      </thead>

      <tbody>
        <?php
        foreach ($data['kegiatan'] as $item) {
          switch ($item->ctingkat) {
            case 'l':
              $tingkat = "Lokal";
              break;
            
            case 'n':
              $tingkat = "Nasional";
              break;
            
            case 'i':
              $tingkat = "Internasional";
              break;
            
            default:
              $tingkat = "ERROR !!!";
              break;
          }
          ?>
          <tr>
            <th><?php echo $item->cnokegiatan; ?></th>
            <th><?php echo $item->cnmkegiatan; ?></th>
            <th><?php echo $tingkat; ?></th>
            <th><?php echo $this->db->get_where('mkategori', array('cnokategori' => $item->cnokategori))->row()->cnmkategori; ?></th>
              <th>
                <a class="btn btn-primary" href="<?php echo base_url('kegiatan/detail/'.$item->cnokegiatan) ?>"> <i class="fa fa-share"></i> Detail</a>
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
function hapus(id) {
  if (confirm("Yakin hapus ?")) {
    window.location = "<?php echo base_url('kegiatan/aksi_hapus/'); ?>" + id;
  }
}
</script>
