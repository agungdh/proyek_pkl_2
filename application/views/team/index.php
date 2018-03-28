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

    <?php
    if ($data['team_id'] != null) {
      $action = base_url('team/aksi_ubah/');
      $cnoteam = $data['team_id']->cnoteam;
      $cnmteam = $data['team_id']->cnmteam;
      $cnokegiatan = $data['team_id']->cnokegiatan;
      $cjmlagt = $data['team_id']->cjmlagt;
      $csmt = $data['team_id']->csmt;
      $cthnajar = $data['team_id']->cthnajar;
      $dtglawallomba = $data['team_id']->dtglawallomba;
      $dtglakhirlomba = $data['team_id']->dtglakhirlomba;
      $ctempatlomba = $data['team_id']->ctempatlomba;
      $cfoto = $data['team_id']->cfoto;
    } else {
      $action = base_url('team/aksi_tambah/');
      $cnoteam = 'T' . str_pad($data['ai'],4,"0",STR_PAD_LEFT);
      $cnmteam = null;
      $cnokegiatan = null;
      $cjmlagt = null;
      $csmt = null;
      $cthnajar = null;
      $dtglawallomba = null;
      $dtglakhirlomba = null;
      $ctempatlomba = null;
      $cfoto = null;
    }

    if ($cfoto == null) {
      $cfoto = 'assets/noimages.svg';
    }
    ?>

    <form name="form" id="form" role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
      <div class="box-body">

      <div class="form-group">
        <label for="noteam">NO Team</label>
            <input readonly value="<?php echo $cnoteam; ?>" required type="text" class="form-control" id="noteam" placeholder="Isi NO Team" name="noteam">
      </div>

      <div class="form-group">
        <label for="kegiatan">Kegiatan</label>
            <select class="form-control" name="nokegiatan">
              <?php
              foreach ($this->db->get('mkegiatan')->result() as $item) {
                if ($item->cnokegiatan == $cnokegiatan) {
                   ?>
                  <option selected value="<?php echo $item->cnokegiatan; ?>"><?php echo $item->cnmkegiatan; ?></option>
                  <?php
                } else {
                   ?>
                  <option value="<?php echo $item->cnokegiatan; ?>"><?php echo $item->cnmkegiatan; ?></option>
                  <?php
                }
              }
              ?>
            </select>
      </div>

      <div class="form-group">
        <label for="nmteam">Nama Team</label>
            <input value="<?php echo $cnmteam; ?>" required type="text" class="form-control" id="nmteam" placeholder="Isi Nama Team" name="nmteam">
      </div>

      <div class="form-group">
        <label for="jumlah">Jumlah Anggota</label>
            <input value="<?php echo $cjmlagt; ?>" required min="1" max="100" type="number" class="form-control" id="jumlah" placeholder="Isi Jumlah Anggota" name="jumlah">
      </div>

      <div class="form-group">
        <label for="semester">Semester</label>
            <select class="form-control" name="semester">
              <option <?php echo $csmt == 'o' ? 'selected' : null; ?> value="o">Ganjil</option>
              <option <?php echo $csmt == 'e' ? 'selected' : null; ?> value="e">Genap</option>
            </select>
      </div>

      <div class="form-group">
        <label for="tahun_ajar">Tahun Ajar</label>
            <input value="<?php echo substr($cthnajar, 0, 4); ?>" required type="number" min="1900" max="2900" class="" id="tahun_ajar" placeholder="Isi Tahun Ajar" name="tahun_ajar_awal">
            /
            <input value="<?php echo substr($cthnajar, 4, 4); ?>" required type="number" min="1900" max="2900" class="" id="tahun_ajar" placeholder="Isi Tahun Ajar" name="tahun_ajar_akhir">
      </div>

      <div class="form-group">
        <label for="tanggal_lomba">Tanggal Lomba</label>
            <input value="<?php echo $dtglawallomba; ?>" required type="date" class="" id="tanggal_lomba" placeholder="Isi Tahun Ajar" name="tanggal_lomba_awal">
            -
            <input value="<?php echo $dtglakhirlomba; ?>" required type="date" class="" id="tanggal_lomba" placeholder="Isi Tahun Ajar" name="tanggal_lomba_akhir">
      </div>

      <div class="form-group">
        <label for="tempat_lomba">Tempat Lomba</label>
            <input value="<?php echo $ctempatlomba; ?>" required type="text" class="form-control" id="tempat_lomba" placeholder="Isi Tempat Lomba" name="tempat_lomba">
      </div>

      <div class="form-group">
        <label for="foto">Foto</label>
        <br>
        <?php
        if ($data['team_id'] != null) {
          ?>
          <img src="<?php echo base_url($cfoto); ?>" width="200px" height="200px">
          <?php
        }
        ?>
            <input type="file" class="form-control" id="foto" placeholder="Isi Foto" name="foto">
      </div>

      <input type="hidden" name="userentri" value="<?php echo $this->session->cuserentri; ?>">
      <input type="hidden" name="tglentri" value="<?php echo date('Y-m-d'); ?>">

      </div><!-- /.box-body -->

      <div class="box-footer">
        <?php
        if ($data['team_id'] == null) {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Tambah Data" />
          <input class="btn btn-info" name="proses" type="reset" value="Batal" />
          <?php
        } else {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Ubah Data" />
          <a href="<?php echo base_url('team'); ?>" class="btn btn-info">Batal</a>
          <?php
        }
        ?>
      </div>
    </form>
    </div>

    <form method="get" action="<?php echo base_url('team'); ?>">
      Kegiatan:
      <select name="cnoteam">
        <?php
        foreach ($this->db->get('mkegiatan')->result() as $item) {
          ?>
          <option value="<?php echo $item->cnokegiatan; ?>"><?php echo $item->cnmkegiatan; ?></option>
          <?php
        }
        ?>
      </select>
      <input type="submit" value="Filter">
    </form>
    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>NO Team</th>
                    <th>Team</th>
                    <th>Jumlah Anggota</th>
                    <th>Semester</th>
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
              <th>
                <a class="btn btn-info" href="<?php echo base_url('team/index/'.$item->cnoteam) ?>"> <i class="fa fa-pencil"></i></a>
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
    window.location = "<?php echo base_url('team/aksi_hapus/'); ?>" + id;
  }
}
</script>
