<div class="box box-primary">
  <div class="box-header with-border">
    <h4><strong><font color=blue>TAMBAH KEGIATAN</font></strong></h4>
  </div><!-- /.box-header -->

  <!-- form start -->
  <form name="form" id="form" role="form" method="post" action="<?php echo base_url('kegiatan/aksi_tambah/'); ?>">
    <div class="box-body">

    <div class="form-group">
      <label for="nokegiatan">NO Kegiatan</label>
          <input required type="text" class="form-control" id="nokegiatan" placeholder="Isi NO Kegiatan" name="nokegiatan">
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
</div><!-- /.box -->

<script type="text/javascript">
  $(function () {
    $('.select2').select2()
  });
</script>