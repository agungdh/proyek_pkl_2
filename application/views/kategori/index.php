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
      <a href='<?php echo base_url("kategoriprestasi/tambah/"); ?>'><button class="btn btn-success"><i class="fa fa-plus"></i> Kategori</button></a>
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
                <a class="btn btn-info" href="<?php echo base_url('kategoriprestasi/ubah/'.$item->cnokategori) ?>"> <i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger" onclick="hapus('<?php echo $item->cnokategori; ?>')"> <i class="fa fa-trash"></i></a>
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
    window.location = "<?php echo base_url('kategoriprestasi/aksi_hapus/'); ?>" + id;
  }
}
</script>
