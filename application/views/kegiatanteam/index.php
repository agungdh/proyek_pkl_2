<?php 
// var_dump($data['versi_borang']);
// exit();
?>
<script type="text/javascript" language="javascript" >
  $(document).ready(function() {
    $('#lookup2').DataTable({
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
      
    <?php
    if ($data['kegiatan_id'] != null) {
      $action = base_url('kegiatan/aksi_ubah/');
      $cnokegiatan = $data['kegiatan_id']->cnokegiatan;
      $cnmkegiatan = $data['kegiatan_id']->cnmkegiatan;
      $ctingkat = $data['kegiatan_id']->ctingkat;
      $cnokategori = $data['kegiatan_id']->cnokategori;
    } else {
      $action = base_url('kegiatan/aksi_tambah/');
      $cnokegiatan = str_pad($data['ai'],3,"0",STR_PAD_LEFT);
      $cnmkegiatan = null;
      $ctingkat = null;
      $cnokategori = null;
    }
    ?>

       <form name="form" id="form" role="form" method="post" action="<?php echo $action; ?>">
    <div class="box-body">

    <div class="form-group">
      <label for="nokegiatan">NO Kegiatan</label>
          <input readonly value="<?php echo $cnokegiatan; ?>" required type="text" class="form-control" id="nokegiatan" placeholder="Isi NO Kegiatan" name="nokegiatan">
    </div>

    <div class="form-group">
      <label for="kegiatan">Kegiatan</label>
          <input required value="<?php echo $cnmkegiatan; ?>" type="text" class="form-control" id="kegiatan" placeholder="Isi Kegiatan" name="kegiatan">
    </div>

    <div class="form-group">
      <label for="tingkat">Tingkat</label>
          <select class="form-control select2" name="tingkat">
            <option <?php echo $ctingkat == 'l' ? 'selected' : null; ?> value="l">Lokal</option>
            <option <?php echo $ctingkat == 'n' ? 'selected' : null; ?> value="n">Nasional</option>
            <option <?php echo $ctingkat == 'i' ? 'selected' : null; ?> value="i">Internasional</option>
          </select>
    </div>

    <div class="form-group">
      <label for="nokategori">Kategori</label>
          <select class="form-control select2" name="nokategori">
            <?php
            foreach ($this->db->get('mkategori')->result() as $item) {
              if ($item->cnokategori == $cnokategori) {
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
        <?php
        if ($data['kegiatan_id'] == null) {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Tambah Data" />
          <input class="btn btn-info" name="proses" type="reset" value="Batal" />
          <?php
        } else {
          ?>
          <input class="btn btn-success" name="proses" type="submit" value="Ubah Data" />
          <a href="<?php echo base_url('kegiatan'); ?>" class="btn btn-info">Batal</a>
          <a class="btn btn-danger" onclick="hapus('<?php echo $cnokegiatan; ?>')"> Hapus</a>
          <?php
        }
        ?>
    </div>
  </form>

    </div>

<?php 
if ($data['kegiatan_id'] != null) {
  ?>
      <h4><strong><font color=blue>DATA TEAM</font></strong></h4>

    <table id="lookup" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
                    <th>TEAM</th>
                    <th>JUMLAH ANGGOTA</th>
                    <th>SEMESTER</th>
                    <th>TAHUN AJAR</th>
                    <th>TANGGAL LOMBA</th>
                    <th>TEMPAT LOMBA</th>
                    <th>FOTO TEAM</th>
                    <th>PROSES</th>
        </tr>
      </thead>

      <tbody>

        <tr>
          <form id="kegiatan<?php echo $data["kegiatan_id"]->cnokegiatan; ?>" action="<?php echo base_url('kegiatan/aksi_tambah_team'); ?>" method="post">
            <th><input class="form-control" type="text" name="nama_team"></th>
            <th><input class="form-control" type="text" name="jumlah_anggota"></th>
            <th><input class="form-control" type="text" name="semester"></th>
            <th><input class="form-control" type="number" min="1900" max="2900" name="tahun_ajar_awal">/<input class="form-control" type="number" min="1900" max="2900" name="tahun_ajar_akhir"></th>
            <th><input class="form-control" type="date" name="tanggal_awal_lomba"> - <input class="form-control" type="date" name="tanggal_akhir_lomba"></th>
            <input type="hidden" name="userentri" value="<?php echo $this->session->cuserentri; ?>">
            <input type="hidden" name="tglentri" value="<?php echo date('Y-m-d'); ?>">
            <input type="hidden" name="cnokegiatan" value="<?php echo $data['kegiatan_id']->cnokegiatan; ?>">
            <th><input class="form-control" type="text" name="tempat_lomba"></th>
            <th><input class="form-control" type="file" name="foto_team"></th>
            <th><a class="btn btn-success" onclick="$('#kegiatan<?php echo $data["kegiatan_id"]->cnokegiatan; ?>').submit()"><i class="glyphicon glyphicon-plus"></i></a></th>
          </form>
        </tr>

        <?php
        foreach ($this->db->get_where('mteammhs', array('cnokegiatan' => $data['kegiatan_id']->cnokegiatan))->result() as $item) {
          ?>
          <tr>
            <td><?php echo $item->cnmteam; ?></td>
            <td><?php echo $item->cjmlagt; ?></td>
            <td><?php echo $item->csmt; ?></td>
            <td><?php echo substr($item->cthnajar, 0, 4) . '/' . substr($item->cthnajar, 4, 4); ?></td>
            <td><?php echo $this->pustaka->tanggal_indo($item->dtglawallomba) . ' - ' . $this->pustaka->tanggal_indo($item->dtglakhirlomba); ?></td>
            <td><?php echo $item->ctempatlomba; ?></td>
            <td><?php echo $item->cfoto; ?></td>
            <td><?php echo $item->cnmteam; ?></td>
          </tr>
          <?php
        }
        ?>

      </tbody>
      
    </table>

    <br>
    <br>

  <?php  
}
?>

    <h4><strong><font color=blue>DATA KEGIATAN</font></strong></h4>

    <table id="lookup2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
                <a class="btn btn-primary" href="<?php echo base_url('kegiatan/index/'.$item->cnokegiatan) ?>"> <i class="fa fa-share"></i> Detail</a>
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
