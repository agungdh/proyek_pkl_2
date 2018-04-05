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
    <h4><strong><font color=blue>MAHASISWA</font></strong></h4>
  </div><!-- /.box-header -->

    <div class="box-body">

    <div class="form-group">

    <?php

    if ($data['mahasiswa_id'] != null) {
      $action = base_url('mahasiswa/aksi_ubah/');
      $nim = $data['mahasiswa_id']->cnim;
      $nama = $data['mahasiswa_id']->cnama;
    } else {
      $action = base_url('mahasiswa/aksi_tambah/');
      $nim = null;
      $nama = null;
    }
    ?>

    <form name="form" id="form" role="form" method="post" action="<?php echo $action; ?>">
      <div class="box-body">

      <div class="form-group">
        <label for="nim">NIM</label>
            <input value="<?php echo $nim; ?>" required type="text" class="form-control" id="nim" placeholder="Isi NIM" name="nim">
      </div>

      <div class="form-group">
        <label for="nama">Nama</label>
            <input value="<?php echo $nama; ?>" required type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama">
      </div>

      </div><!-- /.box-body -->

      <div class="box-footer">
        <?php
        if ($data['mahasiswa_id'] == null) {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Tambah Data" />
          <input class="btn btn-info" name="proses" type="reset" value="Batal" />
          <?php
        } else {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Ubah Data" />
          <a href="<?php echo base_url('mahasiswa'); ?>" class="btn btn-info">Batal</a>
          <?php
        }
        ?>
      </div>
    </form>

    </div>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NIM</th>
                    <th>MAHASISWA</th>
                    <th>PROSES</th>
        </tr>
      </thead>

      <tbody>
        <?php
        foreach ($data['mahasiswa'] as $item) {
          ?>
          <tr>
            <th><?php echo $item->cnim; ?></th>
            <th><?php echo $item->cnama; ?></th>
              <th>
                <a data-toggle="tooltip" data-placement="top" title="Edit!" class="btn btn-info" href="<?php echo base_url('mahasiswa/index/'.$item->cnim) ?>"> <i class="fa fa-pencil"></i></a>
                <a data-toggle="tooltip" data-placement="top" title="Hapus!" class="btn btn-danger" onclick="hapus('<?php echo $item->cnim; ?>')"> <i class="fa fa-trash"></i></a>
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
    window.location = "<?php echo base_url('mahasiswa/aksi_hapus/'); ?>" + id;
  }
}
</script>
