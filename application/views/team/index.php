<?php 
// var_dump($data['versi_borang']);
// exit();
?>
<script type="text/javascript" language="javascript" >
  $(document).ready(function() {
    $('#lookup').DataTable({
      responsive: true,
      order: [[ 0, "desc" ]]
    });
    // $('#lookup1').DataTable({
    //   responsive: true,
    //   orderCellsTop: true
    // });
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
    ?>

    <form name="form" id="form" role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
      <div class="box-body">
        <div class="row">

          <div class="col col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="noteam">No Team</label>
                    <input readonly value="<?php echo $cnoteam; ?>" required type="text" class="form-control" id="noteam" placeholder="Isi No Team" name="noteam">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="jumlah">Jumlah Anggota</label>
                      <input value="<?php echo $cjmlagt; ?>" required min="1" max="100" type="number" class="form-control" id="jumlah" placeholder="Isi Jumlah Anggota" name="jumlah">
                </div>
              </div>

            </div>
          </div>


          <div class="col col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="kegiatan">Kegiatan</label>
                  <select class="form-control select2" id="nokegiatan" name="nokegiatan">
                    <option value="">Pilih</option>
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
              </div>

             <div class="col-md-6">
                 <div class="form-group">
                    <label for="tanggal_lomba">Tanggal Lomba</label><br>
                    <input value="<?php echo $dtglawallomba; ?>" required type="date" class="" id="tanggal_lomba_awal" placeholder="Isi Tahun Ajar" name="tanggal_lomba_awal">
                      -
                    <input value="<?php echo $dtglakhirlomba; ?>" required type="date" class="" id="tanggal_lomba_akhir" placeholder="Isi Tahun Ajar" name="tanggal_lomba_akhir">
                  </div>
              </div>
            </div>
          </div>

          <div class="col col-md-12">
            <div class="row">

              <div class="col-md-3">
                <div class="form-group">
                  <label for="nmteam">Tingkat</label>
                  <input readonly type="text" class="form-control" id="kegiatan_tingkat" placeholder="Pilih Kegiatan">
                 </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="nmteam">Kategori</label>
                  <input readonly type="text" class="form-control" id="kegiatan_kategori" placeholder="Pilih Kegiatan">
                 </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="nmteam">Nama Team</label>
                  <input value="<?php echo $cnmteam; ?>" required type="text" class="form-control" id="nmteam" placeholder="Isi Nama Team" name="nmteam">
                 </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control select2" id="semester" name="semester">
                      <option value="">Pilih</option>
                      <option <?php echo $csmt == 'o' ? 'selected' : null; ?> value="o">Gasal</option>
                      <option <?php echo $csmt == 'e' ? 'selected' : null; ?> value="e">Genap</option>
                    </select>
                  </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="tahun_ajar">Tahun Ajar</label><br>
                    <input value="<?php echo substr($cthnajar, 0, 4); ?>" required type="number" min="1900" max="2900" class="" id="tahun_ajar_awal" placeholder="Isi Tahun Ajar" name="tahun_ajar_awal">
                    /
                    <input readonly value="<?php echo substr($cthnajar, 4, 4); ?>" required type="number" min="1900" max="2900" class="" id="tahun_ajar_akhir" placeholder="Isi Tahun Ajar" name="tahun_ajar_akhir">
                </div>
              </div>

            </div>
          </div>

          <div class="col col-md-12">
              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tempat_lomba">Tempat Lomba</label>
                      <input value="<?php echo $ctempatlomba; ?>" required type="text" class="form-control" id="tempat_lomba" placeholder="Isi Tempat Lomba" name="tempat_lomba">
                    </div>
                  </div>

                </div>
                  </div>
              </div>
          </div>
          
          <div class="col col-md-12" >
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                        <label for="foto">Foto</label>
                        <br>
                        <?php
                        if ($data['team_id'] != null) {
                          if (file_exists($cfoto)) {
                          ?>
                          <img src="<?php echo base_url($cfoto); ?>" width="150px" height="150px">
                          <?php            
                          }
                        }
                        ?>
                        <input type="file" class="form-control" id="foto" placeholder="Isi Foto" name="foto">
                  </div>
                </div>  
            </div>                 
          </div>

        

      <input type="hidden" name="userentri" value="<?php echo $this->session->cuserentri; ?>">
      <input type="hidden" name="tglentri" value="<?php echo date('Y-m-d'); ?>">
        </div>
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

        <?php
        if (count($this->db->get_where('tagtteam', array('cnoteam' => $cnoteam))->result()) >= $cjmlagt) {
          $attribTambahan = 'disabled';
          $attribOnClick = null;
        } else {
          $attribTambahan = null;
          $attribOnClick = "$('#form_anggota').submit()";
        }
        ?>
        <form id="form_anggota" action="<?php echo base_url('team/aksi_tambah_anggota'); ?>" method="post" enctype="multipart/form-data">
        <tr>
            <input <?php echo $attribTambahan; ?> type="hidden" name="data[cnoteam]" value="<?php echo $cnoteam; ?>">
            <th colspan="2" style="text-align: center;">
              <select <?php echo $attribTambahan; ?> class="form-control select2" id="dataCnim" name="data[cnim]">
                <option value="">Pilih</option>
                <?php
                $sql = "SELECT *
                        FROM mmhs
                        WHERE cnim NOT IN
                        (
                            SELECT cnim
                            FROM tagtteam
                            WHERE cnoteam = ?
                        )";
                $query = $this->db->query($sql, array($cnoteam))->result();
                foreach ($query as $item) {
                  ?>
                  <option value="<?php echo $item->cnim; ?>"><?php echo $item->cnim . ' | ' . $item->cnama; ?></option>
                  <?php
                }
                ?>
              </select>
            </th>
            <th>
              <input <?php echo $attribTambahan; ?> type="text" name="data[cprestasi]" class="form-control">
            </th>
            <th>
              <input <?php echo $attribTambahan; ?> type="file" name="cbukti" class="form-control">
            </th>
            <th>
              <a data-toggle="tooltip" data-placement="top" title="Tambah!" <?php echo $attribTambahan; ?> class="btn btn-success" onclick="<?php echo $attribOnClick; ?>"> <i class="fa fa-plus">Add</i></a>
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
          <form id="form_anggota_ubah_<?php echo $cnoteam . $item->cnim; ?>" action="<?php echo base_url('team/aksi_ubah_anggota'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="nim" value="<?php echo $item->cnim; ?>">
            <input type="hidden" name="noteam" value="<?php echo $cnoteam; ?>">
            <tr>
              <th><?php echo $item->cnim; ?></th>
              <th><?php echo $this->db->get_where('mmhs', array('cnim' => $item->cnim))->row()->cnama; ?></th>
              <th>
                <input type="text" name="prestasi" value="<?php echo $item->cprestasi; ?> ">
              </th>
              <th>
                <?php
                if (file_exists($item->cbukti)) {
                  ?>
                  <img src="<?php echo base_url($item->cbukti); ?>" width="150" height="150">
                  <?php
                }
                ?>
                <input type="file" name="bukti">
              </th>
                <th>
                  <a data-toggle="tooltip" data-placement="top" title="Edit!" class="btn btn-info" onclick="$('#form_anggota_ubah_<?php echo $cnoteam . $item->cnim; ?>').submit()"> <i class="fa fa-pencil"></i></a>
                  <a data-toggle="tooltip" data-placement="top" title="Hapus!" class="btn btn-danger" onclick="hapus_anggota('<?php echo $item->cnoteam; ?>', '<?php echo $item->cnim; ?>')"> <i class="fa fa-trash"></i></a>
                </th>
            </tr>
          </form>
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
      <select class="select2" name="cnokegiatan">
        <option value="null">Semua</option>  
        <?php
        foreach ($this->db->get('mkegiatan')->result() as $item) {
          if ($item->cnokegiatan == $this->input->get('cnokegiatan')) {
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
      <input type="submit" class="btn btn-default" value="Filter">
    </form>
    <br/>

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
            <th><?php echo $item->csmt == 'e' ? 'Genap' : 'Gasal'; ?></th>
            <th><?php echo substr($item->cthnajar, 0, 4) . '/' . substr($item->cthnajar, 4, 4); ?></th>
            <th><?php echo $this->pustaka->tanggal_indo($item->dtglawallomba) . ' - ' . $this->pustaka->tanggal_indo($item->dtglakhirlomba); ?></th>
            <th><?php echo $item->ctempatlomba; ?></th>
            <th>
              <?php
              if (file_exists($item->cfoto)) {
                ?>
                <img src="<?php echo base_url($item->cfoto); ?>" width="150" height="150">
                <?php
              }
              ?>
            </th>
              <th>
                <a data-toggle="tooltip" data-placement="top" title="Edit!" class="btn btn-info" href="<?php echo base_url('team/index/'.$item->cnoteam) ?>"> <i class="fa fa-pencil"></i></a>
                <a data-toggle="tooltip" data-placement="top" title="Hapus!" class="btn btn-danger" onclick="hapus('<?php echo $item->cnoteam; ?>')"> <i class="fa fa-trash"></i></a>
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
$('form').submit(function () {
  if ($('#nokegiatan').val() == '' || $('#semester').val() == '') {
      alert('Belum pilih');
      return false;
  }
});
$('#form_anggota').submit(function () {
  if ($('#dataCnim').val() == '') {
      alert('Belum pilih');
      return false;
  }
});
function hapus(id) {
  if (confirm("Yakin hapus ?")) {
    window.location = "<?php echo base_url('team/aksi_hapus/'); ?>" + id;
  }
}
function hapus_anggota(noteam, nim) {
  if (confirm("Yakin hapus ?")) {
    window.location = "<?php echo base_url('team/aksi_hapus_anggota/'); ?>" + noteam + '/' + nim;
  }
}
$('#tahun_ajar_awal').change(function() {
  $('#tahun_ajar_akhir').val(parseInt($('#tahun_ajar_awal').val()) + 1);
});
$('#tahun_ajar_akhir').change(function() {
  $('#tahun_ajar_awal').val(parseInt($('#tahun_ajar_akhir').val()) - 1);
});
$('#tanggal_lomba_awal').change(function() {
  $('#tanggal_lomba_akhir').val($('#tanggal_lomba_awal').val());
});
$('#nokegiatan').change(function() {
  if ($('#nokegiatan').val() == "") {
    $( "#kegiatan_kategori" ).val( "Pilih Kegiatan" );
    $( "#kegiatan_tingkat" ).val( "Pilih Kegiatan" );
  } else {
    $.post( "<?php echo base_url('team/ambil_detail_kegiatan/'); ?>" + $('#nokegiatan').val(), function( data ) {
      var json = jQuery.parseJSON(data);
      // console.log(json.kategori);
      // console.log(json.tingkat);
      $( "#kegiatan_kategori" ).val( json.kategori );
      $( "#kegiatan_tingkat" ).val( json.tingkat );
    });
  }
});
</script>
