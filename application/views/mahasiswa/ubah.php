<div class="box box-primary">
  <div class="box-header with-border">
    <h4><strong><font color=blue>UBAH MAHASISWA</font></strong></h4>
  </div><!-- /.box-header -->

  <!-- form start -->
  <form name="form" id="form" role="form" method="post" action="<?php echo base_url('mahasiswa/aksi_ubah/'); ?>">
    <div class="box-body">

    <div class="form-group">
      <label for="nim">NIM</label>
          <input readonly required value="<?php echo $data['mahasiswa']->cnim; ?>" type="text" class="form-control" id="nim" placeholder="Isi NIM" name="nim">
    </div>

    <div class="form-group">
      <label for="nama">Nama</label>
          <input required value="<?php echo $data['mahasiswa']->cnama; ?>" type="text" class="form-control" id="nama" placeholder="Isi Nama" name="nama">
    </div>

    </div><!-- /.box-body -->

    <div class="box-footer">
      <input class="btn btn-success" name="proses" type="submit" value="Simpan Data" />
      <a href="<?php echo base_url('mahasiswa'); ?>" class="btn btn-info">Batal</a>
    </div>
  </form>
</div><!-- /.box -->