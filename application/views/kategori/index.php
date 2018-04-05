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
    <h4><strong><font color=blue>KATEGORI</font></strong></h4>
  </div><!-- /.box-header -->

    <div class="box-body">

    <div class="form-group">

    <?php
    if ($data['kategori_id'] != null) {
      $action = base_url('kategori/aksi_ubah/');
      $cnokategori = $data['kategori_id']->cnokategori;
      $cnmkategori = $data['kategori_id']->cnmkategori;
    } else {
      $action = base_url('kategori/aksi_tambah/');
      $cnokategori = str_pad($data['ai'],3,"0",STR_PAD_LEFT);
      $cnmkategori = null;
    }
    ?>

    <form name="form" id="form" role="form" method="post" action="<?php echo $action; ?>">
      <div class="box-body">

      <div class="form-group">

        <label for="nokategori">NO Kategori</label>
            <input readonly value="<?php echo $cnokategori; ?>" required type="text" class="form-control" id="nokategori" placeholder="Isi NO Kategori" name="nokategori">
      </div>

      <div class="form-group">
        <label for="kategori">Kategori</label>
            <input value="<?php echo $cnmkategori; ?>" required type="text" class="form-control" id="kategori" placeholder="Isi Kategori" name="kategori">
      </div>

      </div><!-- /.box-body -->

      <div class="box-footer">
        <?php
        if ($data['kategori_id'] == null) {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Tambah Data" />
          <input class="btn btn-info" name="proses" type="reset" value="Batal" />
          <?php
        } else {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Ubah Data" />
          <a href="<?php echo base_url('kategori'); ?>" class="btn btn-info">Batal</a>
          <?php
        }
        ?>
      </div>
    </form>
    </div>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO KATEGORI</th>
                    <th>KATEGORI</th>
                    <th>PROSES</th>
        </tr>
      </thead>

      <tbody>
        <?php
        foreach ($data['kategori'] as $item) {
          ?>
          <tr>
            <th><?php echo $item->cnokategori; ?></th>
            <th><?php echo $item->cnmkategori; ?></th>
              <th>
                <a data-toggle="tooltip" data-placement="top" title="Edit!" class="btn btn-info" href="<?php echo base_url('kategori/index/'.$item->cnokategori) ?>"> <i class="fa fa-pencil"></i></a>
                <a data-toggle="tooltip" data-placement="top" title="Hapus!" class="btn btn-danger" onclick="hapus('<?php echo $item->cnokategori; ?>')"> <i class="fa fa-trash"></i></a>
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
    window.location = "<?php echo base_url('kategori/aksi_hapus/'); ?>" + id;
  }
}
</script>
