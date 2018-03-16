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
    <h4><strong><font color=blue>TEAM</font></strong></h4>
  </div><!-- /.box-header -->

    <div class="box-body">

    <div class="form-group">
      <a href='<?php echo base_url("team/tambah/" . $data['kegiatan']->cnokegiatan); ?>'><button class="btn btn-success"><i class="fa fa-plus"></i> Team</button></a>
    </div>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO TEAM</th>
                    <th>TEAM</th>
                    <th>JUMLAH ANGGOTA</th>
                    <th>SEMESTER</th>
                    <th>TAHUN AJAR</th>
                    <th>TANGGAL AWAL</th>
                    <th>TANGGAL AKHIR</th>
                    <th>TEMPAT</th>
                    <th>PRESTASI</th>
                    <th>BUKTI</th>
                    <th>FOTO</th>
                    <th>PROSES</th>
        </tr>
      </thead>

      <tbody>
        <?php
        foreach ($data['team'] as $item) {
          ?>
          <tr>
            <th><?php echo $item->cnoteam; ?></th>
            <th><?php echo $item->cnmteam; ?></th>
            <th><?php echo $item->cjmlagt; ?></th>
            <th><?php echo $item->csmt == 'o' ? 'Gasal' : 'Genap'; ?></th>
            <th><?php echo substr($item->cthnajar, 0, 4) . '/' . substr($item->cthnajar, 4, 4); ?></th>
            <th><?php echo $this->pustaka->tanggal_indo($item->ctglawallomba); ?></th>
            <th><?php echo $this->pustaka->tanggal_indo($item->ctglakhirlomba); ?></th>
            <th><?php echo $item->ctempatlomba; ?></th>
            <th><?php echo $item->cprestasi; ?></th>
            <th><?php echo $item->cbukti; ?></th>
            <th><?php echo $item->cfoto; ?></th>
              <th>
                <a class="btn btn-primary" href="<?php echo base_url('anggota/index/'.$item->cnoteam) ?>"> <i class="fa fa-share"></i> Anggota</a>
                <a class="btn btn-info" href="<?php echo base_url('team/ubah/'.$item->cnoteam) ?>"> <i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger" onclick="hapus('<?php echo $item->cnoteam; ?>')"> <i class="fa fa-trash"></i></a>
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
    window.location = "<?php echo base_url('team/aksi_hapus/' . $data['kegiatan']->cnokegiatan . '/'); ?>" + id;
  }
}
</script>
