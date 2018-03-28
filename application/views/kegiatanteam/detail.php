<div class="box box-primary">
  <div class="box-header with-border">
    <h4><strong><font color=blue>TAMBAH KEGIATAN</font></strong></h4>
  </div><!-- /.box-header -->

  <!-- form start -->
  <form name="form" id="form" role="form" method="post" action="<?php echo base_url('kegiatan/aksi_tambah/'); ?>">
    <div class="box-body">

    <div class="form-group">
      <label for="nokegiatan">NO Kegiatan</label>
          <input readonly value="<?php echo $data['kegiatan']->cnokegiatan; ?>" required type="text" class="form-control" id="nokegiatan" placeholder="Isi NO Kegiatan" name="nokegiatan">
    </div>

    <div class="form-group">
      <label for="kegiatan">Kegiatan</label>
          <input value="<?php echo $data['kegiatan']->cnmkegiatan; ?>" required type="text" class="form-control" id="kegiatan" placeholder="Isi Kegiatan" name="kegiatan">
    </div>

    <div class="form-group">
      <label for="tingkat">Tingkat</label>
          <select class="form-control select2" name="tingkat">
            <option <?php echo $data['kegiatan']->ctingkat == "l" ? "selected" : null  ?> value="l">Lokal</option>
            <option <?php echo $data['kegiatan']->ctingkat == "n" ? "selected" : null  ?> value="n">Nasional</option>
            <option <?php echo $data['kegiatan']->ctingkat == "i" ? "selected" : null  ?> value="i">Internasional</option>
          </select>
    </div>

    <div class="form-group">
      <label for="nokategori">Kategori</label>
          <select class="form-control select2" name="nokategori">
            <?php
            foreach ($this->db->get('mkategori')->result() as $item) {
              if ($item->cnokategori == $data['kegiatan']->cnokategori) {
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

    </div><!-- /.box-body -->

    <div class="box-footer">
      <input class="btn btn-success" name="proses" type="submit" value="Simpan Data" />
      <a href="<?php echo base_url('kegiatan'); ?>" class="btn btn-info">Batal</a>
    </div>
  </form>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO KEGIATAN</th>
                    <th>KEGIATAN</th>
                    <th>KATEGORI</th>
                    <th>PROSES</th>
        </tr>
      </thead>

      <tbody>
        <?php
        foreach ($data['kegiatan'] as $item) {
          ?>
          <tr>
            <th><?php echo $item->cnokegiatan; ?></th>
            <th><?php echo $item->cnmkegiatan; ?></th>
            <th><?php echo $this->db->get_where('mkategori', array('cnokategori' => $item->cnokategori))->row()->cnmkategori; ?></th>
              <th>
                <a class="btn btn-primary" href="<?php echo base_url('team/index/'.$item->cnokegiatan) ?>"> <i class="fa fa-share"></i> Team</a>
                <a class="btn btn-info" href="<?php echo base_url('kegiatan/ubah/'.$item->cnokegiatan) ?>"> <i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger" onclick="hapus('<?php echo $item->cnokegiatan; ?>')"> <i class="fa fa-trash"></i></a>
              </th>
          </tr>
          <?php
        }
        ?>
      </tbody>
      
    </table>
</div><!-- /.box -->

<script type="text/javascript">
  $(function () {
    $('.select2').select2()
  });

var dTable;
$(document).ready(function() {
  dTable = $('#lookup').DataTable({
    responsive: true
  });
});
</script>