<?php 
// var_dump($data['versi_borang']);
// exit();
?>
<script type="text/javascript" language="javascript" >
  $(document).ready(function() {
    $('#lookup').DataTable({
      responsive: true
    });
    $('#lookup1').DataTable({
      responsive: true,
      orderCellsTop: true
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

    <?php
    if ($data['team_id'] != null) {
      ?>
          <h4><strong><font color=blue>DATA ANGGOTA</font></strong></h4>

    <table id="lookup1" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
            <th>NIM</th>
            <th>NAMA</th>
            <th>PRESTASI</th>
            <th>BUKTI</th>
            <th>PROSES</th>
        </tr>
        <form id="form_anggota" action="" method="post" enctype="multipart/form-data">
        <tr>
            <th colspan="2" style="text-align: right;">
              <select class="form-control">
                <?php
                foreach ($this->db->get('mmhs')->result() as $item) {
                  ?>
                  <option value="<?php echo $item->cnim; ?>"><?php echo $item->cnim . ' | ' . $item->cnama; ?></option>
                  <?php
                }
                ?>
              </select>
            </th>
            <th>
              <input type="text" name="" class="form-control">
            </th>
            <th>
              <input type="file" name="" class="form-control">
            </th>
            <th>
              <a class="btn btn-danger" onclick="$('#form_anggota').submit()"> <i class="fa fa-trash"></i></a>
            </th>
        </tr>
        </form>
      </thead>

      <tbody>
        <?php
        $where['cnoteam'] = $cnoteam;
        $this->db->where($where);
        foreach ($this->db->get('tagtteam')->result() as $item) {
          ?>
          <tr>
            <th><?php echo $item->cnim; ?></th>
            <th><?php echo $this->db->get_where('mmhs', array('cnim' => $item->cnim))->row()->cnama; ?></th>
            <th><?php echo $item->cprestasi; ?></th>
            <th><img src="<?php echo base_url($item->cbukti); ?>" width="150" height="150"></th>
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
    
    <br><br>
      <?php
    }
    ?>

    <h4><strong><font color=blue>DATA TEAM</font></strong></h4>
    
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
                    <th>NO TEAM</th>
                    <th>KEGIATAN</th>
                    <th>TEAM</th>
                    <th>JUMLAH ANGGOTA</th>
                    <th>SEMESTER</th>
                    <th>TAHUN AJAR</th>
                    <th>TANGGAL LOMBA</th>
                    <th>TEMPAT LOMBA</th>
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
            <th><?php echo $this->db->get_where('mkegiatan', array('cnokegiatan' => $item->cnokegiatan))->row()->cnmkegiatan; ?></th>
            <th><?php echo $item->cnmteam; ?></th>
            <th><?php echo $item->cjmlagt; ?></th>
            <th><?php echo $item->csmt == 'e' ? 'Genap' : 'Ganjil'; ?></th>
            <th><?php echo substr($item->cthnajar, 0, 4) . '/' . substr($item->cthnajar, 4, 4); ?></th>
            <th><?php echo $this->pustaka->tanggal_indo($item->dtglawallomba) . ' - ' . $this->pustaka->tanggal_indo($item->dtglakhirlomba); ?></th>
            <th><?php echo $item->ctempatlomba; ?></th>
            <th><img src="<?php echo base_url($item->cfoto); ?>" width="150" height="150"></th>
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
