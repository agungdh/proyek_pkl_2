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
      <a href='<?php echo base_url("mahasiswa/tambah/"); ?>'><button class="btn btn-success"><i class="fa fa-plus"></i> Mahasiswa</button></a>
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
                <a class="btn btn-info" href="<?php echo base_url('mahasiswa/ubah/'.$item->cnim) ?>"> <i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger" onclick="hapus('<?php echo $item->cnim; ?>')"> <i class="fa fa-trash"></i></a>
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
