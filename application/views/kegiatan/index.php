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
      $ctingkat = $data['kegiatan_id']->ctingkat;
      $cnokategori = $data['kegiatan_id']->cnokategori;
    } else {
      $action = base_url('kegiatan/aksi_tambah/');
      $cnokegiatan = str_pad($data['ai'],3,"0",STR_PAD_LEFT);
      $cnmkegiatan = null;
      $ctingkat = null;
      $cnokategori = null;
    }
    ?>

    <form name="form" id="form" role="form" method="post" action="<?php echo $action; ?>">
    <div class="box-body">
      <div class="col col-md-12">
        <div class="row">
          <div class="col-md-6">
             <div class="form-group">
                <label for="nokegiatan">NO Kegiatan</label>
                    <input readonly value="<?php echo $cnokegiatan; ?>" required type="text" class="form-control" id="nokegiatan" placeholder="Isi NO Kegiatan" name="nokegiatan">
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="kegiatan">Kegiatan</label>
                  <input required value="<?php echo $cnmkegiatan; ?>" type="text" class="form-control" id="kegiatan" placeholder="Isi Kegiatan" name="kegiatan">
            </div>
          </div>
        </div>
      </div>

      <div class="col col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tingkat">Tingkat</label>
                  <select class="form-control select2" id="tingkat" name="tingkat">
                    <option value="">Pilih</option>
                    <option <?php echo $ctingkat == 'l' ? 'selected' : null; ?> value="l">Lokal</option>
                    <option <?php echo $ctingkat == 'n' ? 'selected' : null; ?> value="n">Nasional</option>
                    <option <?php echo $ctingkat == 'i' ? 'selected' : null; ?> value="i">Internasional</option>
                  </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="nokategori">Kategori</label>
                  <select class="form-control select2" id="nokategori" name="nokategori">
                    <option value="">Pilih</option>
                    <?php
                    foreach ($this->db->get('mkategori')->result() as $item) {
                      if ($item->cnokategori == $cnokategori) {
                        ?>
                        <option selected value="<?php echo $item->cnokategori; ?>"><?php echo $item->cnmkategori; ?></option>
                        <?php
                      } else {
                        ?>
                        <option value="<?php echo $item->cnokategori; ?>"><?php echo $item->cnmkategori; ?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
        <?php
        if ($data['kegiatan_id'] == null) {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Tambah Data" />
          <input class="btn btn-info" name="proses" type="reset" value="Batal" />
          <?php
        } else {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Ubah Data" />
          <a href="<?php echo base_url('kegiatan'); ?>" class="btn btn-info">Batal</a>
          <?php
        }
        ?>
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
                <a data-toggle="tooltip" data-placement="top" title="Edit!" class="btn btn-info" href="<?php echo base_url('kegiatan/index/'.$item->cnokegiatan) ?>"> <i class="fa fa-pencil"></i></a>
                <a data-toggle="tooltip" data-placement="top" title="Hapus!" class="btn btn-danger" onclick="hapus('<?php echo $item->cnokegiatan; ?>')"> <i class="fa fa-trash"></i></a>
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

$('form').submit(function () {
  if ($('#nokategori').val() == '' || $('#tingkat').val() == '') {
      alert('Belum pilih');
      return false;
  }
});
</script>
