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
      <a href='<?php echo base_url("kegiatan/tambah/"); ?>'><button class="btn btn-success"><i class="fa fa-plus"></i> Kegiatan</button></a>
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
                <a class="btn btn-info" href="<?php echo base_url('kegiatan/ubah/'.$item->cnokegiatan) ?>"> <i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger" onclick="hapus('<?php echo $item->cnokegiatan; ?>')"> <i class="fa fa-trash"></i></a>
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
