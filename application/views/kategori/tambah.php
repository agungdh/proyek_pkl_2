<div class="box box-primary">
  <div class="box-header with-border">
    <h4><strong><font color=blue>TAMBAH KATEGORI</font></strong></h4>
  </div><!-- /.box-header -->

  <!-- form start -->
  <form name="form" id="form" role="form" method="post" action="<?php echo base_url('kategoriprestasi/aksi_tambah/'); ?>">
    <div class="box-body">

    <div class="form-group">
      <label for="nokategori">NO Kategori</label>
          <input required type="text" class="form-control" id="nokategori" placeholder="Isi NO Kategori" name="nokategori">
    </div>

    <div class="form-group">
      <label for="kategori">Kategori</label>
          <input required type="text" class="form-control" id="kategori" placeholder="Isi Kategori" name="kategori">
    </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
      <input class="btn btn-success" name="proses" type="submit" value="Simpan Data" />
      <a href="<?php echo base_url('kategoriprestasi'); ?>" class="btn btn-info">Batal</a>
    </div>
  </form>
</div><!-- /.box -->