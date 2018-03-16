<div class="box box-primary">
  <div class="box-header with-border">
    <h4><strong><font color=blue>TAMBAH TEAM</font></strong></h4>
  </div><!-- /.box-header -->

  <!-- form start -->
  <form name="form" id="form" role="form" method="post" action="<?php echo base_url('team/aksi_tambah/' . $data['kegiatan']->cnokegiatan); ?>">
    <div class="box-body">

    <div class="form-group">
      <label for="noteam">NO Team</label>
          <input required type="text" class="form-control" id="noteam" placeholder="Isi NO Team" name="noteam">
    </div>

    <div class="form-group">
      <label for="team">Team</label>
          <input required type="text" class="form-control" id="team" placeholder="Isi Team" name="team">
    </div>

    <div class="form-group">
      <label for="jumlah">Jumlah</label>
          <input required type="number" class="form-control" id="jumlah" placeholder="Isi Jumlah" name="jumlah">
    </div>

    <div class="form-group">
      <label for="semester">Semester</label>
          <select name="semester" class="form-control select2">
            <option value="o">Gasal</option>
            <option value="e">Genap</option>
          </select>
    </div>

    <div class="form-group">
      <label for="tahunajar">Tahun Ajar</label>
          <input required type="number" id="tahunajar" placeholder="Isi Tahun Ajar" name="tahunajar1">/
          <input required type="number" id="tahunajar" placeholder="Isi Tahun Ajar" name="tahunajar2">
    </div>

    <div class="form-group">
      <label for="tanggalawal">Tanggal Awal</label>
          <input required type="date" class="form-control" id="tanggalawal" placeholder="Isi Tanggal Awal" name="tanggalawal">
    </div>

    <div class="form-group">
      <label for="tanggalakhir">Tanggal Akhir</label>
          <input required type="date" class="form-control" id="tanggalakhir" placeholder="Isi Tanggal Akhir" name="tanggalakhir">
    </div>

    <div class="form-group">
      <label for="tempatlomba">Tempat Lomba</label>
          <input required type="text" class="form-control" id="tempatlomba" placeholder="Isi Tempat Lomba" name="tempatlomba">
    </div>

    <div class="form-group">
      <label for="prestasi">Prestasi</label>
          <input required type="text" class="form-control" id="prestasi" placeholder="Isi Prestasi" name="prestasi">
    </div>

    <div class="form-group">
      <label for="bukti">Bukti</label>
          <input required type="file" class="form-control" id="bukti" placeholder="Isi bukti" name="bukti">
    </div>

    <div class="form-group">
      <label for="foto">Foto</label>
          <input required type="file" class="form-control" id="foto" placeholder="Isi foto" name="foto">
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